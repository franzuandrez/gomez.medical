<?php

namespace App\Services\v1\Employee;

use App\DTOs\v1\BaseAbstractDto;

use App\DTOs\v1\Employee\EmployeeAddUserDto;
use App\Models\Employee;
use App\Services\v1\ServiceInterface;

class EmployeeAddUserService implements ServiceInterface
{
    private $dto;

    public function __construct(EmployeeAddUserDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof EmployeeAddUserDto) {

            throw new \InvalidArgumentException(
                'EmployeeAddUserService needs to receive a EmployeeAddUserDto'
            );
        }

        return new EmployeeAddUserService($dto);
    }

    public function execute()
    {

        $employee = Employee::findOrFail($this->dto->getEmployeeId());
        $employee->login_id = $this->dto->getLoginId();
        $employee->save();

        return $employee->toArray();


    }
}
