<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessEntityResource extends JsonResource
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
            'business_entity_id' => $this->business_entity_id,
            'email_addresses' => $this->emailAddress,
            'addresses' => BusinessEntityAddressResource::collection($this->businessEntityAddress),
            'phone_numbers' => PhoneNumberResource::collection($this->phones)
        ];
    }
}
