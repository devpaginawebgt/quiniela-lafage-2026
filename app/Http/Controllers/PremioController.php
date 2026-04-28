<?php

namespace App\Http\Controllers;

use App\Http\Resources\Line\LinePremiosResource;
use App\Http\Resources\Premio\PremioResource;
use App\Http\Services\LineService;
use App\Http\Services\PremioService;
use App\Http\Services\UserService;
use App\Models\Brand;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PremioController extends Controller
{   
    use ApiResponse;

    public function __construct(
        private readonly PremioService $premioService,
        private readonly LineService $lineService,
    ) {}

    // API Responses

    public function getPremios(Request $request)
    {
        $user = $request->user();

        $line_id = (int) $user->line_id;

        $line = $this->lineService->getLine($line_id);

        if (empty($line)) {

            $this->errorResponse('Ocurrió un error al identificar la línea del usuario', 500);

        }

        $line->premios = $this->premioService->getPremios($line_id);

        $line = new LinePremiosResource($line);

        return $this->successResponse($line);
    }
}
