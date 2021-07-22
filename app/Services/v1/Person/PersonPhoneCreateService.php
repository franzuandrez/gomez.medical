<?php


namespace App\Services\v1\Person;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Person\PersonPhoneCreateDto;
use App\Models\PersonPhone;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PersonPhoneCreateService implements ServiceInterface
{


    private $dto;


    public function __construct(PersonPhoneCreateDto $dto)
    {

        $this->dto = $dto;


    }


    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PersonPhoneCreateDto) {
            throw new InvalidArgumentException(
                'PersonPhoneCreateService needs to receive a PersonPhoneCreateDto.'
            );
        }
        return new PersonPhoneCreateService($dto);
    }

    public function execute()
    {

        $person_phone = new PersonPhone();
        $person_phone->business_entity_id = $this->dto->getBusinessEntityId();
        $person_phone->phone_number = $this->dto->getPhoneNumber();
        $person_phone->phone_number_type_id = $this->dto->getPhoneNumberTypeId();
        $person_phone->save();

        return $person_phone->toArray();

    }
}
