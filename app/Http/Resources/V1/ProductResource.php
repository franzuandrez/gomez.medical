<?php

namespace App\Http\Resources\V1;

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
            'sku' => $this->sku,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'description_formatted' => strip_tags($this->description),
            'color' => $this->color,
            'size' => $this->size,
            'weight' => $this->weight,
            'instructions' => $this->instructions,
            'subcategory' => new ProductSubCategoryResource($this->subcategory),
            'current_price' => new ProductPriceResource($this->currentPrice),
            'images' => $this->photos,
            'brand' => $this->brand,
            'sizeMeasure' => $this->sizeMeasure,
            'weightMeasure' => $this->weightMeasure,
        ];
    }
}
