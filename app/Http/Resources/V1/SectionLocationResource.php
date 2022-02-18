<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionLocationResource extends JsonResource
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
            'section_id' => $this->section_id,
            'name' => $this->name,
            'warehouse' => new WarehouseResource($this->warehouse)

        ];
    }
}
