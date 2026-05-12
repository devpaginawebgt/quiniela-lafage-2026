<?php

namespace App\Http\Resources\PrivacyPolicy;

use Illuminate\Http\Resources\Json\JsonResource;

class PrivacyPolicyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'version' => $this->version,
            'content' => $this->content,
        ];
    }
}
