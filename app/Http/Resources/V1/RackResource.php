<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class RackResource extends JsonResource
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
            'rack_id' => $this->rack_id,
            'name' => $this->name,
            'corridor' => new CorridorResource($this->corridor)

        ];
    }
}
