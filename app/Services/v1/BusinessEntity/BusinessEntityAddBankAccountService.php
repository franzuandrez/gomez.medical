<?php

namespace App\Services\v1\BusinessEntity;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\BusinessEntity\BusinessEntityAddBankAccountDto;
use App\Models\BusinessEntityBankAccount;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class BusinessEntityAddBankAccountService implements ServiceInterface
{



    private $dto;



    public function __construct( BusinessEntityAddBankAccountDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if(!$dto instanceof  BusinessEntityAddBankAccountDto){
            throw  new InvalidArgumentException(
                'BusinessEntityAddBankAccountService needs to receive a BusinessEntityAddBankAccountDto.'
            );
        }

        return new BusinessEntityAddBankAccountService($dto);
    }

    public function execute()
    {
        $bankAccount = new BusinessEntityBankAccount();
        $bankAccount->business_entity_id = $this->dto->getBusinessEntityId();
        $bankAccount->account_number = $this->dto->getAccountNumber();
        $bankAccount->bank_id = $this->dto->getBankId();
        $bankAccount->is_default = 0;
        $bankAccount->save();

        return $bankAccount->toArray();
    }
}
