<?php


namespace App\Services\v1\PhoneNumberType;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\PhoneNumberType\PhoneNumberTypeEditDto;
use App\Models\PhoneNumberType;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PhoneNumberTypeEditService implements ServiceInterface
{


    private $dto;


    public function __construct(PhoneNumberTypeEditDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PhoneNumberTypeEditDto) {
            throw new InvalidArgumentException(
                'PhoneNumberTypeEditService needs to receive a PhoneNumberTypeEditDto.'
            );
        }
        return new PhoneNumberTypeEditService($dto);
    }

    public function execute()
    {

        $type = PhoneNumberType::findOrFail($this->dto->getPhoneNumberTypeId());
        $type->name = $this->dto->getName();
        $type->update();
        return $type->toArray();

    }
}
