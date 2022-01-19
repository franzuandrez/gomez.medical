<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ControlCashRegisterHeaderResource extends JsonResource
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
            'started_at' => $this->started_at,
            'status' => $this->status,
            'ended_at' => $this->ended_at,
            'shift' => new ShiftResource($this->shift),
            'cash_register' => $this->cash_register,
            'supervisor' => new EmployeeResource($this->supervisor),
            'sales_person' => new SalesPersonResource($this->sales_person),
            'detail' => $this->detail,

        ];
    }
}
