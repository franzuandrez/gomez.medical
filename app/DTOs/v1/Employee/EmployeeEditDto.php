<?php

namespace App\DTOs\v1\Employee;

use App\DTOs\v1\BaseAbstractDto;

class EmployeeEditDto extends BaseAbstractDto
{

    private $employee_id;

    private $national_id_number;
    private $job_title;
    private $birth_date;
    private $marital_status;
    private $gender;

    /**
     * @return mixed
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }



    /**
     * @return mixed
     */
    public function getNationalIdNumber()
    {
        return $this->national_id_number;
    }

    /**
     * @return mixed
     */
    public function getJobTitle()
    {
        return $this->job_title;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * @return mixed
     */
    public function getMaritalStatus()
    {
        return $this->marital_status;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'employee_id' => 'required',
            'national_id_number' => 'required',
            'job_title' => 'required',
            'birth_date' => 'required',
            'marital_status' => 'required',
            'gender' => 'required',

        ];
    }

    protected function map(array $data): bool
    {
        $this->employee_id = $data['employee_id'];
        $this->national_id_number = $data['national_id_number'];
        $this->birth_date = $data['birth_date'];
        $this->job_title = $data['job_title'];
        $this->marital_status = $data['marital_status'];
        $this->gender = $data['gender'];
        return true;
    }
}
