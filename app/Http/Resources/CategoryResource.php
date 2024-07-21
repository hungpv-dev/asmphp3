<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "ma" => $this->id,
            "ten" => $this->name,
            "danh_muc_cha" => $this->parent_id,
            "trang_thai" => $this->status
        ];
    }
}
