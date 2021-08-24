<?php


namespace App\Services\v1\Employee;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Employee\EmployeeAddDto;
use App\Models\Employee;
use App\Services\v1\ServiceInterface;

class EmployeeAddService implements ServiceInterface
{


    private $dto;

    public function __construct(EmployeeAddDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof EmployeeAddDto) {

            throw new \InvalidArgumentException(
                'EmployeeAddService needs to receive a EmployeeAddDto'
            );
        }

        return new EmployeeAddService($dto);
    }

    public function execute()
    {

        $employee = new Employee();
        $employee->business_entity_id = $this->dto->getBusinessEntityId();
        $employee->national_id_number = $this->dto->getNationalIdNumber();
        $employee->birth_date = $this->dto->getBirthDate();
        $employee->job_title = $this->dto->getJobTitle();
        $employee->marital_status = $this->dto->getMaritalStatus();
        $employee->gender = $this->dto->getGender();
        $employee->hired_date = $this->dto->getBirthDate();
        $employee->save();

        return $employee->toArray();


    }
}
