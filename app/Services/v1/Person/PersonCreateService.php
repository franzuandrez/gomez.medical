<?php


namespace App\Services\v1\Person;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Person\PersonCreateDto;
use App\Models\BusinessEntity;
use App\Models\Person;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PersonCreateService implements ServiceInterface
{


    private $dto;

    public function __construct(PersonCreateDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PersonCreateDto) {
            throw new InvalidArgumentException(
                'PersonCreateService needs to receive a PersonCreateDto.'
            );
        }
        return new PersonCreateService($dto);
    }

    public function execute()
    {

        $person = new Person();
        $person->business_entity_id = $this->dto->getBusinessEntityId();
        $person->person_type = $this->dto->getPersonType();
        $person->title = $this->dto->getTitle();
        $person->first_name = $this->dto->getFirstName();
        $person->middle_name = $this->dto->getMiddleName();
        $person->last_name = $this->dto->getLastName();
        $person->suffix = $this->dto->getSuffix();
        $person->save();

        return $person->toArray();
    }
}
