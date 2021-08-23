<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $employee = $this->employee;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'displayName' => $this->name,
            'email' => $this->email,
            'employee' => $employee,
            'person'=> $employee->businessEntity->person,
            'business_entity' => new BusinessEntityResource($employee->businessEntity)
        ];
    }
}
