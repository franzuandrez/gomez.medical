<?php

namespace App\Services\v1\Employee;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Employee\EmployeeEditDto;
use App\Models\Employee;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class EmployeeEditService implements ServiceInterface
{


    private $dto;

    public function __construct(EmployeeEditDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof EmployeeEditDto) {
            throw new InvalidArgumentException(
                'EmployeeEditService needs to receive a EmployeeEditDto.'
            );
        }
        return new EmployeeEditService($dto);
    }

    public function execute()
    {

        $employee = Employee::findOrFail($this->dto->getEmployeeId());
        $employee->national_id_number = $this->dto->getNationalId();
        $employee->birth_date = $this->dto->getBirthDate();
        $employee->job_title = $this->dto->getJobTitle();
        $employee->marital_status = $this->dto->getMaritalStatus();
        $employee->gender = $this->dto->getGender();
        $employee->update();

        return $employee->toArray();
    }
}
