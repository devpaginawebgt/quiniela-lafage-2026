<?php

namespace App\Http\Services;

use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetService
{
    public const OTP_EXPIRATION_MINUTES         = 20;
    public const RESET_TOKEN_EXPIRATION_MINUTES = 20;
    public const MAX_VERIFY_ATTEMPTS            = 5;

    public const ERR_EMAIL_NOT_FOUND     = 'EMAIL_NOT_FOUND';
    public const ERR_OTP_INVALID         = 'OTP_INVALID';
    public const ERR_OTP_EXPIRED         = 'OTP_EXPIRED';
    public const ERR_OTP_MAX_ATTEMPTS    = 'OTP_MAX_ATTEMPTS';
    public const ERR_RESET_TOKEN_INVALID = 'RESET_TOKEN_INVALID';
    public const ERR_RESET_TOKEN_EXPIRED = 'RESET_TOKEN_EXPIRED';
    public const ERR_RESET_TOKEN_USED    = 'RESET_TOKEN_USED';

    public function issueCode(User $user, ?string $ip = null, ?string $userAgent = null): string
    {
        PasswordResetCode::where('email', $user->email)
            ->whereNull('used_at')
            ->update([
                'used_at'    => now(),
                'expires_at' => now(),
            ]);

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        PasswordResetCode::create([
            'email'      => $user->email,
            'code_hash'  => Hash::make($otp),
            'attempts'   => 0,
            'expires_at' => now()->addMinutes(self::OTP_EXPIRATION_MINUTES),
            'ip'         => $ip,
            'user_agent' => $userAgent,
        ]);

        return $otp;
    }

    public function verifyCode(string $email, string $code): array
    {
        $record = PasswordResetCode::where('email', $email)
            ->whereNull('used_at')
            ->latest('id')
            ->first();

        if (empty($record)) {
            return [
                'ok'         => false,
                'message'    => 'El código ingresado no es válido.',
                'error_code' => self::ERR_OTP_INVALID,
                'status'     => 422,
            ];
        }

        if ($record->attempts >= self::MAX_VERIFY_ATTEMPTS) {
            $record->update(['used_at' => now()]);

            return [
                'ok'         => false,
                'message'    => 'Has superado el número máximo de intentos. Solicita un nuevo código.',
                'error_code' => self::ERR_OTP_MAX_ATTEMPTS,
                'status'     => 429,
            ];
        }

        if ($record->isExpired()) {
            return [
                'ok'         => false,
                'message'    => 'El código ha expirado. Solicita uno nuevo.',
                'error_code' => self::ERR_OTP_EXPIRED,
                'status'     => 410,
            ];
        }

        if (!Hash::check($code, $record->code_hash)) {
            $record->increment('attempts');

            return [
                'ok'         => false,
                'message'    => 'El código ingresado no es válido.',
                'error_code' => self::ERR_OTP_INVALID,
                'status'     => 422,
            ];
        }

        $resetToken = bin2hex(random_bytes(32));

        $record->update([
            'reset_token_hash'       => Hash::make($resetToken),
            'reset_token_expires_at' => now()->addMinutes(self::RESET_TOKEN_EXPIRATION_MINUTES),
            'verified_at'            => now(),
        ]);

        return [
            'ok'   => true,
            'data' => [
                'reset_token'        => $resetToken,
                'expires_in_minutes' => self::RESET_TOKEN_EXPIRATION_MINUTES,
            ],
        ];
    }

    public function consumeResetToken(string $email, string $resetToken, string $newPassword): array
    {
        $record = PasswordResetCode::where('email', $email)
            ->whereNotNull('verified_at')
            ->whereNull('used_at')
            ->latest('id')
            ->first();

        if (empty($record) || empty($record->reset_token_hash)) {
            return [
                'ok'         => false,
                'message'    => 'El token de recuperación no es válido.',
                'error_code' => self::ERR_RESET_TOKEN_INVALID,
                'status'     => 422,
            ];
        }

        if ($record->resetTokenIsExpired()) {
            return [
                'ok'         => false,
                'message'    => 'El token de recuperación ha expirado. Solicita un nuevo código.',
                'error_code' => self::ERR_RESET_TOKEN_EXPIRED,
                'status'     => 410,
            ];
        }

        if (!Hash::check($resetToken, $record->reset_token_hash)) {
            return [
                'ok'         => false,
                'message'    => 'El token de recuperación no es válido.',
                'error_code' => self::ERR_RESET_TOKEN_INVALID,
                'status'     => 422,
            ];
        }

        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return [
                'ok'         => false,
                'message'    => 'El token de recuperación no es válido.',
                'error_code' => self::ERR_RESET_TOKEN_INVALID,
                'status'     => 422,
            ];
        }

        DB::transaction(function () use ($user, $newPassword, $record) {
            $user->update(['password' => Hash::make($newPassword)]);
            $user->tokens()->delete();
            DB::table('sessions')->where('user_id', $user->id)->delete();
            $record->update(['used_at' => now()]);
        });

        return [
            'ok'   => true,
            'data' => [],
        ];
    }
}
