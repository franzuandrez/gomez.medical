<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
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
            'vendor_id' => $this->vendor_id,
            'business_entity' => new BusinessEntityResource($this->businessEntity),
            'products' => VendorProductsResource::collection($this->products),
            'account_number' => $this->account_number,
            'name' => $this->name,
            'url_web' => $this->url_web,
            'active_flag' => $this->active_flag
        ];
    }
}
