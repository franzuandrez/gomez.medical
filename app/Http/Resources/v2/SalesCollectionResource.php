<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesCollectionResource extends JsonResource
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
            'total_due' => $this->total_due ,
            'status' => $this->status,
            'sales_order_number' => $this->sales_order_number,
            'customer' =>
                ($this->business_name === null || $this->business_name === "")
                    ?
                    ($this->customer_first_name . " " . $this->customer_last_name)
                    : ($this->business_name),
            'nit' => $this->nit,
            'address_line_1' => $this->address_line_1,
            'city' => $this->city,

        ];
    }
}
