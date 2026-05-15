<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyResetCodeRequest;
use App\Http\Services\PasswordResetService;
use App\Mail\PasswordResetCodeMail;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ApiPasswordResetController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly PasswordResetService $passwordResetService,
    ) {}

    public function forgot(ForgotPasswordRequest $request): JsonResponse
    {
        $request->ensureIsNotRateLimited();

        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (empty($user)) {
            $request->hitRateLimiter();

            return $this->errorResponse(
                'No encontramos una cuenta registrada con ese correo electrónico.',
                404,
                [],
                PasswordResetService::ERR_EMAIL_NOT_FOUND,
            );
        }

        $otp = $this->passwordResetService->issueCode(
            $user,
            $request->ip(),
            $request->userAgent(),
        );

        Mail::to($user->email)->send(new PasswordResetCodeMail(
            user: $user,
            code: $otp,
            expiresInMinutes: PasswordResetService::OTP_EXPIRATION_MINUTES,
        ));

        $request->hitRateLimiter();

        return $this->successResponse([
            'message' => 'Te enviamos un código de verificación a tu correo electrónico.',
        ]);
    }

    public function verifyCode(VerifyResetCodeRequest $request): JsonResponse
    {
        $request->ensureIsNotRateLimited();

        $data = $request->validated();

        $result = $this->passwordResetService->verifyCode($data['email'], $data['code']);

        if (!$result['ok']) {
            $request->hitRateLimiter();

            return $this->errorResponse(
                $result['message'],
                $result['status'],
                [],
                $result['error_code'],
            );
        }

        return $this->successResponse($result['data']);
    }

    public function reset(ResetPasswordRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->passwordResetService->consumeResetToken(
            $data['email'],
            $data['reset_token'],
            $data['password'],
        );

        if (!$result['ok']) {
            return $this->errorResponse(
                $result['message'],
                $result['status'],
                [],
                $result['error_code'],
            );
        }

        return $this->successResponse([
            'message' => 'Tu contraseña ha sido restablecida correctamente. Inicia sesión con tu nueva contraseña.',
        ]);
    }
}
