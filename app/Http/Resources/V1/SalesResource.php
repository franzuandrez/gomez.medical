<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
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
            'order_date' => $this->order_date,
            'paid' => $this->paid === 1,
            'customer' => new CustomerResource($this->customer),
            'sales_person' => $this->salesPerson,
            'bill_address' => $this->billAddress,
            'ship_address' => $this->shipAddress,
            'ship_method' => $this->shipMethod,
            'detail' => $this->salesOrderDetail
        ];
    }
}
