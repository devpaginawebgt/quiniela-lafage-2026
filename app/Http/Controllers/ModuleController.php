<?php

namespace App\Http\Controllers;

use App\Http\Resources\Banner\BannerResource;
use App\Http\Services\ModuleService;
use App\Models\Module;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly ModuleService $moduleService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function banners(Request $request, string $module_code)
    {
        $module = $this->moduleService->getModule($module_code);

        if (empty($module)) {
            return $this->errorResponse('No se encontró el módulo', 422);
        }

        $user = $request->user();

        if (!$user->completed_info) return $this->successResponse([]);

        $banners = $this->moduleService->getBanners($module->id);

        $banners = BannerResource::collection($banners);

        return $this->successResponse($banners);
    }

}
