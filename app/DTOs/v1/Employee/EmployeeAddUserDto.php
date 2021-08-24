<?php

namespace App\DTOs\v1\Employee;

use App\DTOs\v1\BaseAbstractDto;

class EmployeeAddUserDto extends BaseAbstractDto

{

    private $login_id;
    private $employee_id;

    /**
     * @return mixed
     */
    public function getLoginId()
    {
        return $this->login_id;
    }

    /**
     * @return mixed
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'employee_id' => 'required',
            'login_id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->login_id = $data['login_id'];
        $this->employee_id = $data['employee_id'];

        return true;
    }
}
