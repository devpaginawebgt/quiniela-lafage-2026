<?php

namespace App\Http\Services;

use App\Http\Resources\PrivacyPolicy\PrivacyPolicyResource;
use App\Models\PrivacyPolicy;

class PrivacyPolicyService
{

    public function getPrivacyPolicy()
    {
        return PrivacyPolicy::where('is_active', true)->first();
    }
}
