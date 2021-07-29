<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDetailResource extends JsonResource
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
            'id' => $this->id,
            'purchase_order_id' => $this->purchase_order_id,
            'due_date' => $this->due_date,
            'order_quantity' => floatval($this->order_quantity),
            'product' => new ProductResource($this->product),
            'unit_price' => floatval($this->unit_price),
            'line_total' => floatval($this->line_total),
            'received_quantity' => floatval($this->received_quantity),
            'rejected_quantity' => floatval($this->rejected_quantity),
            'stocked_quantity' => floatval($this->stocked_quantity),

        ];
    }
}
