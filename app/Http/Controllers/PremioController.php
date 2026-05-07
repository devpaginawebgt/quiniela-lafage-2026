<?php

namespace App\Http\Controllers;

use App\Http\Resources\Line\LinePremiosResource;
use App\Http\Services\LineService;
use App\Http\Services\PremioService;
use App\Http\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
class PremioController extends Controller
{   
    use ApiResponse;

    public function __construct(
        private readonly PremioService $premioService,
        private readonly UserService $userService,
        private readonly LineService $lineService,
    ) {}

    // API Responses

    public function getPremios(Request $request)
    {
        $user = $request->user();

        $line_id = (int) $user->line_id;

        if (!$user->completed_info) {
            return $this->errorResponse("Por favor, completa tu información en la sección 'Perfil' para acceder a la sección de premios", 403, [], 'PROFILE_INCOMPLETE');
        }

        $line = $this->lineService->getLine($line_id);

        $line->premios = $this->premioService->getPremios($line_id);

        $line = new LinePremiosResource($line);

        return $this->successResponse($line);
    }
}
