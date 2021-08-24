<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        $businessEntity = $this->businessEntity;
        return [
            'employee_id' => $this->employee_id,
            'national_id_number' => $this->national_id_number,
            'job_title' => $this->job_title,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'hired_date' => $this->hired_date,
            'person' => [
                'person_id' => $businessEntity->person->person_id,
                'title' => $businessEntity->person->title,
                'first_name' => $businessEntity->person->first_name,
                'middle_name' => $businessEntity->person->middle_name,
                'last_name' => $businessEntity->person->last_name,
            ],
            'user' => [
                'id' => $this->user ? $this->user->id : '',
                'username' => $this->user ? $this->user->name : '',
                'email' => $this->user ? $this->user->email : '',
            ],
            'business_entity' => new BusinessEntityResource($businessEntity),

        ];
    }
}
