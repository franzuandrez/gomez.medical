<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->product_id . '|' . $this->batch . '|' . $this->bin,
            'batch' => $this->batch,
            'best_before' => $this->best_before,
            'bin' => $this->bin,
            'sku' => $this->sku,
            'product_id' => $this->product_id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => strip_tags($this->description) ,
            'color' => $this->color,
            'size' => $this->size,
            'category' => $this->category,
            'brand' => $this->brand,
            'subcategory' => $this->subcategory,
            'stock' => floatval($this->stock),
            'images' => $this->product->photos,
            'price' => new ProductPriceResource($this->product->currentPrice)
        ];
    }
}
