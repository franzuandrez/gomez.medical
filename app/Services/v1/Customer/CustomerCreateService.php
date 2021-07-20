<?php


namespace App\Services\v1\Customer;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Customer\CustomerCreateDto;
use App\Models\Customer;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class CustomerCreateService implements ServiceInterface
{


    private $dto;


    public function __construct(CustomerCreateDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof CustomerCreateDto) {
            throw new InvalidArgumentException(
                'CustomerCreateService needs to receive a CustomerCreateDto.'
            );
        }
        return new CustomerCreateService($dto);

    }

    public function execute()
    {


        $customer = new Customer();
        $customer->person_id = $this->dto->getPersonId();
        $customer->business_entity_id = $this->dto->getBusinessEntityId();
        $customer->nit = $this->dto->getNit();
        $customer->save();

        return $customer->toArray();


    }
}
