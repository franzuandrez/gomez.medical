<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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

            'customer_id' => $this->customer_id,
            'business_name' => $this->business_name,
            'nit' => $this->nit,
            'person' => [
                'person_id' => $this->person_id,
                'person_type' => $this->person_type,
                'title' => $this->title,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
            ],
            'business_entity' => new BusinessEntityResource($this->businessEntity)
        ];
    }
}
