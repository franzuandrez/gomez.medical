<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessEntityAddressResource extends JsonResource
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
            'business_address_id' => $this->business_address_id,
            'address' => $this->address,
            'address_type' => $this->addressType
        ];
    }
}
