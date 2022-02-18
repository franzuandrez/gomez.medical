<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class PrintoutCollectionResource extends JsonResource
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
            'product_id' => $this->product_id,
            'name' => $this->name,
            'description' => strip_tags($this->description),
            'sku' => $this->sku,
            'quantity' => $this->quantity,
            'quantity_printed' => $this->quantity_printed,
            'printed_by' => $this->printed_by,
            'is_printed' => $this->is_printed,
        ];
    }
}
