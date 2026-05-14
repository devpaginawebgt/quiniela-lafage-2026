<?php

namespace App\Http\Services;

use App\Models\LegalDocument;

class LegalDocumentService
{
    public function getByType(string $type): ?LegalDocument
    {
        return LegalDocument::where('type', $type)
            ->where('is_active', true)
            ->first();
    }
}
