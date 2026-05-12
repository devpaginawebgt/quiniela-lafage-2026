<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrivacyPolicy\PrivacyPolicyResource;
use App\Http\Services\PrivacyPolicyService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly PrivacyPolicyService $privacyPolicyService
    ) {}

    public function index()
    {
        $privacyPolicy = $this->privacyPolicyService->getPrivacyPolicy();
        $privacyPolicy = new PrivacyPolicyResource($privacyPolicy);

        return $this->successResponse($privacyPolicy);
    }
}
