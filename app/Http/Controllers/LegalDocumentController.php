<?php

namespace App\Http\Controllers;

use App\Http\Resources\LegalDocument\LegalDocumentResource;
use App\Http\Services\LegalDocumentService;
use App\Traits\ApiResponse;

class LegalDocumentController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly LegalDocumentService $legalDocumentService
    ) {}

    public function show(string $type)
    {
        $document = $this->legalDocumentService->getByType($type);

        return $this->successResponse(new LegalDocumentResource($document));
    }
}
