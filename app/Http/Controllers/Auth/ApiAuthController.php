<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiLoginRequest;
use App\Http\Requests\Auth\ApiRegisterRequest;
use App\Http\Resources\User\UserRankResource;
use App\Http\Services\CodigoService;
use App\Http\Services\UserService;
use App\Models\Avatar;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly UserService $userService,
        private readonly CodigoService $codigoService,
    ) {}

    public function login(ApiLoginRequest $request)
    {
        $request->ensureIsNotRateLimited();

        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (empty($user) || !Hash::check($data['password'], $user->password)) {
            $request->hitRateLimiter();

            return $this->errorResponse('Credenciales incorrectas, revisa la información ingresada.', 401);
        }

        if ($user->status_user == 0) {
            return $this->errorResponse('No es posible ingresar con este usuario, para más información contacte a Soporte.', 401);
        }

        $token = $user->createToken('mobile-app')->plainTextToken;

        $user = $this->userService->getUserRank($user);

        return $this->successResponse([
            'token' => $token,
            'user'  => new UserRankResource($user),
        ]);
    }

    public function register(ApiRegisterRequest $request)
    {   
        $data = $request->validated();

        $codigo = null;

        if ((int)$data['user_type_id'] === 1) {
            $result = $this->codigoService->validate($data['code']);
    
            if (!$result['success']) {
                throw ValidationException::withMessages(['codigo' => $result['message']]);
            }
    
            $codigo = $result['codigo'];

            $data['codigo_id'] = $codigo->id;

            $data['line_id'] = $codigo->line_id;
        }        

        $data['password'] = Hash::make($data['password']);

        $data['avatar_id'] = Avatar::where('is_default', true)->value('id');

        $user = User::create($data);

        $user->refresh();

        $user->assignRole('participant');

        event(new Registered($user));

        $token = $user->createToken('mobile-app')->plainTextToken;

        $user = $this->userService->getUserRank($user);

        $user = new UserRankResource($user);

        return $this->successResponse([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(['message' => 'Sesión cerrada correctamente.']);
    }

    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->successResponse(['message' => 'Se ha cerrado sesión en todos los dispositivos.']);
    }
}
