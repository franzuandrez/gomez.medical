<?php

namespace App\Http\Resources\V1;

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
            'sales_order_id' => $this->sales_order_id,
            'sales_order_number' => $this->sales_order_number,
            'order_date' => $this->order_date,
            'total_due' => $this->total_due,
            'freight' => $this->freight,
            'subtotal' => $this->subtotal,
            'paid' => $this->paid === 1,
            'customer' => new CustomerResource($this->customer),
            'sales_person' => $this->salesPerson,
            'bill_address' => $this->billAddress,
            'ship_address' => $this->shipAddress,
            'ship_method' => $this->shipMethod,
            'detail' => SalesDetailResource::collection($this->salesOrderDetail)
        ];
    }
}
