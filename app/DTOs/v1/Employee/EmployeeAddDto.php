<?php


namespace App\DTOs\v1\Employee;


use App\DTOs\v1\BaseAbstractDto;

class EmployeeAddDto extends BaseAbstractDto
{


    private $business_entity_id;
    private $national_id_number;
    private $job_title;
    private $birth_date;
    private $marital_status;
    private $gender;
    private $hired_date;

    /**
     * @return mixed
     */
    public function getBusinessEntityId()
    {
        return $this->business_entity_id;
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

    /**
     * @return mixed
     */
    public function getHiredDate()
    {
        return $this->hired_date;
    }

    protected function configureValidatorRules(): array
    {

        return [
            'business_entity_id' => 'required',
            'national_id_number' => 'required',
            'job_title' => 'required',
            'birth_date' => 'required',
            'marital_status' => 'required',
            'gender' => 'required',
            'hired_date' => 'required'
        ];
    }

    protected function map(array $data): bool
    {
        $this->business_entity_id = $data['business_entity_id'];
        $this->national_id_number = $data['national_id_number'];
        $this->birth_date = $data['birth_date'];
        $this->job_title = $data['job_title'];
        $this->marital_status = $data['marital_status'];
        $this->gender = $data['gender'];
        $this->hired_date = $data['hired_date'];
        return true;
    }
}
