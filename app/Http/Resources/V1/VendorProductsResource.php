<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'product_vendor_id' => $this->product_vendor_id,
                'vendor_id' => $this->vendor_id,
                'product' => new ProductResource($this->product),
                'cost' => floatval($this->standard_price),
            ];
    }
}
