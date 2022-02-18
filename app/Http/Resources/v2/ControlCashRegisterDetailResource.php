<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class ControlCashRegisterDetailResource extends JsonResource
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
            'sales_person' => $this->sales_person,
            'shift' => new ShiftResource($this->shift),
            'cash_register'=> new ControlCashRegisterHeaderResource($this->cash_register)
        ];
    }
}
