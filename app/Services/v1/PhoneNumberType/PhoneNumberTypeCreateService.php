<?php


namespace App\Services\v1\PhoneNumberType;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\PhoneNumberType\PhoneNumberTypeCreateDto;
use App\Models\PhoneNumberType;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PhoneNumberTypeCreateService implements ServiceInterface
{


    private $dto;


    public function __construct(PhoneNumberTypeCreateDto $dto)
    {

        $this->dto = $dto;
    }


    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PhoneNumberTypeCreateDto) {
            throw new InvalidArgumentException(
                'PhoneNumberTypeCreateService needs to receive a PhoneNumberTypeCreateDto.'
            );
        }
        return new PhoneNumberTypeCreateService($dto);
    }

    public function execute()
    {


        $type = new PhoneNumberType();
        $type->name = $this->dto->getName();
        $type->save();
        return $type->toArray();

    }
}
