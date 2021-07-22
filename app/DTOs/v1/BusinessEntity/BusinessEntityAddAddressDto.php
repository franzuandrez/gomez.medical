<?php


namespace App\DTOs\v1\BusinessEntity;


use App\DTOs\v1\BaseAbstractDto;

class BusinessEntityAddAddressDto extends BaseAbstractDto
{


    private $address_line_1;
    private $address_line_2;
    private $city;
    private $postal_code;
    private $address_type_id;
    private $business_entity_id;

    /**
     * @return mixed
     */
    public function getAddressLine1()
    {
        return $this->address_line_1;
    }

    /**
     * @return mixed
     */
    public function getAddressLine2()
    {
        return $this->address_line_2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @return mixed
     */
    public function getAddressTypeId()
    {
        return $this->address_type_id;
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
            'address_line_1' => 'required',
            'city' => 'required',
            'address_type_id' => 'required',
        ];


    }

    protected function map(array $data): bool
    {


        $this->address_line_1 = $data['address_line_1'];
        $this->business_entity_id = $data['business_entity_id'];
        $this->address_line_2 = $data['address_line_2'];
        $this->city = $data['city'];
        $this->postal_code = $data['postal_code'];
        $this->address_type_id = $data['address_type_id'];

        return true;
    }
}
