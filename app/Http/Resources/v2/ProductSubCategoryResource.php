<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSubCategoryResource extends JsonResource
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
            'product_subcategory_id' => $this->product_subcategory_id,
            'name' => $this->name,
            'category' => new ProductCategoryResource($this->productCategory)
        ];
    }
}
