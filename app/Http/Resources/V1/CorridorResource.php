<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class CorridorResource extends JsonResource
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
            'corridor_id' => $this->corridor_id,
            'name' => $this->name,
            'section' => new SectionLocationResource($this->section),
        ];
    }
}
