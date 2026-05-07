<?php

namespace App\Http\Services;

use App\Models\Banner;
use App\Models\Line;
use App\Models\Module;

class ModuleService {

    public function getModule(string $module_code)
    {
        return Module::where('code', $module_code)->first();
    }

    public function getBanners(string|int $module_id)
    {
        $user = request()->user();
        
        if (empty($user) || empty($user->line_id)) return [];

        return Banner::whereHas('brand', fn ($q) => $q->where('line_id', $user->line_id))
            ->where('module_id', $module_id)
            ->where('is_active', true)
            ->get();
    }

}