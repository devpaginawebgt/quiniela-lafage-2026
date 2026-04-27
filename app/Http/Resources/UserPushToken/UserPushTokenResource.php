<?php

namespace App\Http\Resources\UserPushToken;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPushTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'deviceToken' => $this->device_token,
            'devicePlatform' => $this->device_platform,
        ];
    }
}
