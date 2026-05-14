<?php

namespace App\Http\Resources\LegalDocument;

use Illuminate\Http\Resources\Json\JsonResource;

class LegalDocumentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'version' => $this->version,
            'content' => $this->content,
        ];
    }
}
