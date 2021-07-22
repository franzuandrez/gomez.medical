<?php


namespace App\DTOs\v1\Person;


use App\DTOs\v1\BaseAbstractDto;

class PersonPhoneCreateDto extends BaseAbstractDto
{


    private $phone_number;
    private $business_entity_id;
    private $phone_number_type_id;


    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

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
    public function getPhoneNumberTypeId()
    {
        return $this->phone_number_type_id;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'phone_number' => 'required',
            'business_entity_id' => 'required',
            'phone_number_type_id' => 'required',
        ];

    }

    protected function map(array $data): bool
    {

        $this->phone_number = $data['phone_number'];
        $this->business_entity_id = $data['business_entity_id'];
        $this->phone_number_type_id = $data['phone_number_type_id'];

        return true;

    }
}
