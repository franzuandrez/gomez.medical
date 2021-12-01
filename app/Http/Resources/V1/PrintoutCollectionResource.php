<?php

namespace App\Http\Resources\v1;

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
            'name' => $this->name,
            'description' => strip_tags($this->description),
            'sku' => $this->sku,
            'quantity' => $this->quantity,
            'is_printed' => $this->is_printed,
        ];
    }
}
