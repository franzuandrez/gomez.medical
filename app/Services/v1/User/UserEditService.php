<?php

namespace App\Services\v1\User;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\User\UserEditDto;
use App\Models\User;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class UserEditService implements ServiceInterface
{


    private $dto;


    public function __construct(UserEditDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof UserEditDto) {
            throw new InvalidArgumentException(
                'UserEditService needs to receive a UserEditDto.'
            );
        }
        return new UserEditService($dto);
    }

    public function execute(): array
    {

        $user = User::findOrFail($this->dto->getUserId());

        $isEmailUnique = !User::where('email', $this->dto->getEmail())
            ->where('id', '<>', $user->id)
            ->exists();

        if (!$isEmailUnique) {
            throw new InvalidArgumentException(
                'Correo ya existente'
            );
        }
        $isNameUnique= !User::where('name', $this->dto->getName())
            ->where('id', '<>', $user->id)
            ->exists();

        if (!$isNameUnique) {
            throw new InvalidArgumentException(
                'Usuario ya existente'
            );
        }
        $user->name = $this->dto->getName();
        $user->email = $this->dto->getEmail();
        $user->update();

        return $user->toArray();
    }
}
