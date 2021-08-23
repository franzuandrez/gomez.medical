<?php

namespace App\Services\v1\User;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\User\UserAddDto;
use App\Models\User;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class UserAddService implements ServiceInterface
{


    private $dto;

    public function __construct(USerAddDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof UserAddDto) {
            throw new InvalidArgumentException(
                'UserAddService needs to receive a UserAddDto.'
            );
        }
        return new UserAddService($dto);
    }

    public function execute(): array
    {

        $user = new User();
        $user->name = $this->dto->getName();
        $user->email = $this->dto->getEmail();
        $user->password = \Hash::make($this->dto->getPassword());
        $user->save();

        return $user->toArray();

    }
}
