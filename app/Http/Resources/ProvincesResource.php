<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvincesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ma' => $this->code,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'code_name' => $this->code_name,
            'administrative_unit_id' => $this->administrative_unit_id,
            'administrative_region_id' => $this->administrative_region_id,
        ];
    }
}
