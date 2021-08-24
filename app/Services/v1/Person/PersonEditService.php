<?php

namespace App\Services\v1\Person;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Person\PersonEditDto;
use App\Services\v1\ServiceInterface;
use App\Models\Person;
use InvalidArgumentException;
class PersonEditService implements ServiceInterface
{


    private $dto;

    public function __construct(PersonEditDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PersonEditDto) {
            throw new InvalidArgumentException(
                'PersonEditService needs to receive a PersonEditDto.'
            );
        }
        return new PersonEditService($dto);
    }

    public function execute()
    {
        $person = Person::find($this->dto->getPersonId());
        $person->title = $this->dto->getTitle();
        $person->first_name = $this->dto->getFirstName();
        $person->middle_name = $this->dto->getMiddleName();
        $person->last_name = $this->dto->getLastName();
        $person->suffix = $this->dto->getSuffix();
        $person->save();

        return $person->toArray();
    }
}
