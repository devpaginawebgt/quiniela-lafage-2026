<?php

namespace App\Http\Controllers;

use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Line\LineResource;
use App\Http\Services\LineService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LineController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly LineService $lineService,
    ) {}

    public function index(Request $request)
    {   
        $lines = $this->lineService->getLines();

        $lines = LineResource::collection($lines);

        return $this->successResponse($lines);
    }
}
