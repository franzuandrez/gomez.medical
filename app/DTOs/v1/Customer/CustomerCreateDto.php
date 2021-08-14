<?php


namespace App\DTOs\v1\Customer;


use App\DTOs\v1\BaseAbstractDto;

class CustomerCreateDto extends BaseAbstractDto
{


    private $nit;
    private $business_entity_id;
    private $person_id;
    private $business_name;

    /**
     * @return mixed
     */
    public function getBusinessName()
    {
        return $this->business_name;
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
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * @return mixed
     */
    public function getNit()
    {
        return $this->nit;
    }

    protected function configureValidatorRules(): array
    {

        return [
            'nit' => 'required',
            'business_entity_id' => 'required',

        ];

    }

    protected function map(array $data): bool
    {
        $this->nit = $data['nit'];
        $this->business_entity_id = $data['business_entity_id'];
        $this->business_name = $data['business_name'];
        $this->person_id = $data['person_id'];

        return true;
    }
}
