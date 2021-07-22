<?php


namespace App\Services\v1\BusinessEntity;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\BusinesEntity\BusinessEntityAddAddressDto;
use App\Models\Address;
use App\Models\BusinessEntityAddress;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class BusinessEntityAddAddressService implements ServiceInterface
{


    private $dto;

    public function __construct(BusinessEntityAddAddressDto $dto)
    {

        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof BusinessEntityAddAddressDto) {
            throw new InvalidArgumentException(
                'BusinessEntityAddAddressService needs to receive a BusinessEntityAddAddressDto.'
            );
        }

        return new BusinessEntityAddAddressService($dto);
    }

    public function execute()
    {


        $address = new Address();
        $address->address_line_1 = $this->dto->getAddressLine1();
        $address->address_line_2 = $this->dto->getAddressLine2();
        $address->city = $this->dto->getCity();
        $address->postal_code = $this->dto->getPostalCode();
        $address->save();

        $businessEntityAddress = new BusinessEntityAddress();
        $businessEntityAddress->business_entity_id  = $this->dto->getBusinessEntityId();
        $businessEntityAddress->address_id = $address->address_id;
        $businessEntityAddress->address_type_id = $this->dto->getAddressTypeId();
        $businessEntityAddress->save();

        return $businessEntityAddress->toArray();
    }
}
