<?php

namespace App\DTOs\v1\BusinessEntity;

use App\DTOs\v1\BaseAbstractDto;

class BusinessEntityAddBankAccountDto extends BaseAbstractDto
{

    private $account_number;
    private $bank_id;
    private $business_entity_id;

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->account_number;
    }

    /**
     * @return mixed
     */
    public function getBankId()
    {
        return $this->bank_id;
    }

    /**
     * @return mixed
     */
    public function getBusinessEntityId()
    {
        return $this->business_entity_id;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'business_entity_id' => 'required',
            'bank_id' => 'required',
            'account_number' => 'required'
        ];
    }

    protected function map(array $data): bool
    {

        $this->account_number = $data['account_number'];
        $this->bank_id = $data['bank_id'];
        $this->business_entity_id = $data['business_entity_id'];


        return true;

    }
}
