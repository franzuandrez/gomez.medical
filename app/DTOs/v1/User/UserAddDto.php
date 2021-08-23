<?php

namespace App\DTOs\v1\User;

use App\DTOs\v1\BaseAbstractDto;

class UserAddDto extends BaseAbstractDto
{


    private $name;
    private $email;
    private $password;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }

    protected function map(array $data): bool
    {


        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];

        return true;
    }
}
