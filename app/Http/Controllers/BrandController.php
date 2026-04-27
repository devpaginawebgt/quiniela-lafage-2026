<?php

namespace App\Http\Controllers;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Services\BrandService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly BrandService $brandService
    ) {}

    public function index(Request $request)
    {
        $user = $request->user();

        $line_id = (int)$user->line_id;

        $brands = $this->brandService->getBrands($line_id);

        $brands = BrandResource::collection($brands);

        return $this->successResponse($brands);
    }
}
