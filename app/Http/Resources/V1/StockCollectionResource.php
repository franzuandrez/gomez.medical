<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class StockCollectionResource extends JsonResource
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
            'batch' => $this->batch,
            'best_before' => $this->best_before,
            'bin' => $this->bin,
            'sku' => $this->sku,
            'product_id' => $this->product_id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
            'size' => $this->size,
            'subcategory' => $this->subcategory,
            'stock' => $this->stock,
            'images' => $this->product->photos
        ];

    }
}
