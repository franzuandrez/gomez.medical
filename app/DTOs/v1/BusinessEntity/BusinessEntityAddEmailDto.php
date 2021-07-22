<?php


namespace App\DTOs\v1\BusinessEntity;


use App\DTOs\v1\BaseAbstractDto;

class BusinessEntityAddEmailDto extends BaseAbstractDto
{


    private $business_entity_id;
    private $email_address;

    /**
     * @return mixed
     */
    public function getBusinessEntityId()
    {
        return $this->business_entity_id;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }


    protected function configureValidatorRules(): array
    {


        return [
            'business_entity_id' => 'required',
            'email_address' => 'required'
        ];
    }

    protected function map(array $data): bool
    {


        $this->business_entity_id = $data['business_entity_id'];
        $this->email_address = $data['email_address'];

        return true;

    }
}
