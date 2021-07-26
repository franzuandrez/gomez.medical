<?php

namespace App\Http\Resources\v1;


use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'purchase_order_id' => $this->purchase_order_id,
            'order_date' => $this->order_date,
            'subtotal' => $this->subtotal,
            'tax_amount' => $this->tax_amount,
            'freight' => $this->freight,
            'total_due' => $this->total_due,
            'employee' => $this->employee,
            'vendor' => $this->vendor,
            'ship_method' => $this->shipMethod,
            'detail' => $this->purchaseOrderDetail,
        ];
    }
}
