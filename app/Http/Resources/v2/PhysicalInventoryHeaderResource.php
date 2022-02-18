<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class PhysicalInventoryHeaderResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'employee' => new EmployeeResource($this->employee),
            'status' => 'Terminado',
            'comments' => $this->comments,
            'detail' => PhysicalInventoryDetailResource::collection($this->detail)
        ];
    }
}
