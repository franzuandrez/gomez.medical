<?php


namespace App\Services\v1\BusinessEntity;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\BusinessEntity\BusinessEntityAddEmailDto;
use App\Models\EmailAddress;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class BusinessEntityAddEmailService implements ServiceInterface
{


    private $dto;


    public function __construct(BusinessEntityAddEmailDto $dto)
    {

        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof BusinessEntityAddEmailDto) {

            throw new InvalidArgumentException(
                'BusinessEntityAddEmailService needs to receive a BusinessEntityAddEmailDto.'
            );
        }

        return new BusinessEntityAddEmailService($dto);
    }

    public function execute()
    {


        $emailAddress = new EmailAddress();
        $emailAddress->email_address = $this->dto->getEmailAddress();
        $emailAddress->business_entity_id = $this->dto->getBusinessEntityId();
        $emailAddress->save();

        return $emailAddress->toArray();

    }
}
