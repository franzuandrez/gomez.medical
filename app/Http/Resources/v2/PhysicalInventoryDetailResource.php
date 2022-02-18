<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class PhysicalInventoryDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'header_id' => $this->header_id,
            'product' => new ProductResource($this->product),
            'batch' => $this->batch,
            'location' => new BinResource($this->location),
            'system_quantity' => $this->system_quantity,
            'physical_quantity' => $this->physical_quantity,
            'missing_quantity' => $this->missing_quantity,
            'price' => floatval($this->price),
            'total_system' => floatval($this->total_system),
            'total_physical' => floatval($this->total_physical),
            'total_missing' => floatval($this->total_missing),

        ];
    }
}
