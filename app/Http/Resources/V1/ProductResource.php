<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_id' => $this->product_id,
            'name' => $this->name,
            'color' => $this->color,
            'size' => $this->size,
            'weight' => $this->weight,
            'instructions' => $this->instructions,
            'subcategory' => new ProductSubCategoryResource($this->subcategory),
            'current_price'=> new ProductPriceResource($this->currentPrice)
        ];
    }
}
