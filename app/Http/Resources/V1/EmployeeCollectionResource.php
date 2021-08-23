<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeCollectionResource extends JsonResource
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
            'employee_id' => $this->employee_id,
            'national_id_number' => $this->national_id_number,
            'job_title' => $this->job_title,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'hired_date' => $this->hired_date,
            'title' => $this->title,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name
        ];
    }
}
