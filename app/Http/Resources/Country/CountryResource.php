<?php

namespace App\Http\Resources\Country;

use App\Http\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'name'                   => $this->name,
            'image'                  => HelperService::ImagePath($this->image),
            'countryCode'           => $this->country_code,
            'documentName'          => $this->document_name,
            'documentRegex'         => $this->document_regex,
            'documentRegexMessage' => $this->document_regex_message,
            'areaCode'              => $this->area_code,
        ];
    }
}
