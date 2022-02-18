<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class PhoneNumberResource extends JsonResource
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
            'phone_number' => $this->phone_number,
            'phone_number_type' => new PhoneNumberTypeResource($this->phoneNumberType),
            'default' => boolval($this->default)
        ];
    }
}
