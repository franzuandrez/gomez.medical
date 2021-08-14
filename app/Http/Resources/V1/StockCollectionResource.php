<?php

namespace App\Http\Resources\V1;
;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id' => $this->product_id . '-' . $this->batch,
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
            'stock' => floatval($this->stock),
            'images' => $this->product->photos,
            'price' => new ProductPriceResource($this->product->currentPrice)
        ];

    }
}
