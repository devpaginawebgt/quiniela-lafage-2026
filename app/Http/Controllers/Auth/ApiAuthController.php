<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiLoginRequest;
use App\Http\Requests\Auth\ApiRegisterRequest;
use App\Http\Resources\User\UserRankResource;
use App\Http\Services\CodigoService;
use App\Http\Services\UserService;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
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

        $user = null;

        if ($data['user_type_id'] === 1) {

            $user = $this->userService->getLoginDependiente($request);

        } elseif ($data['user_type_id'] === 2) {

            $user = $this->userService->getLoginDoctor($request);

        }

        if (empty($user)) {

            $request->hitRateLimiter();

            $error_message = '';

            switch($data['user_type_id']) {
                case 1:
                    $error_message = 'No se encontró un dependiente registrado con este número de documento.';
                    break;
                case 2:
                    $error_message = 'No se encontró un doctor registrado con este número de colegiado.';
                    break;
                default:
                    $error_message = 'No se encontró un usuario con este número de documento o colegiado.';
                    break;
            }

            return $this->errorResponse($error_message, 401);

        }

        if ($user->status_user == 0) {

            return $this->errorResponse('No es posible ingresar con este usuario, para más información contacte a Soporte.', 401);

        }

        if ( !Hash::check($request['password'], $user->password) ) { 

            RateLimiter::hit($request->throttleKey());

            return $this->errorResponse('Credenciales incorrectas, revisa la información ingresada.', 401);

        }

        $token = $user->createToken('mobile-app')->plainTextToken;
        
        $user = $this->userService->getUserRank($user);

        $user = $this->userService->getUserPredictionsCount($user);

        $user = new UserRankResource($user);

        return $this->successResponse([
            'token' => $token,
            'user' => $user,
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

        $data['puntos'] = 0;

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

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
