<?php

namespace App\DTOs\v1\User;

use App\DTOs\v1\BaseAbstractDto;

class UserEditDto extends BaseAbstractDto
{


    private $name;
    private $email;
    private $user_id;

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
    public function getUserId()
    {
        return $this->user_id;
    }

    protected function configureValidatorRules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'user_id' => 'required'
        ];
    }

    protected function map(array $data): bool
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->user_id = $data['user_id'];

        return true;
    }
}
