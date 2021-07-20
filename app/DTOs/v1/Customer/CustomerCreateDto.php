<?php


namespace App\DTOs\v1\Customer;


use App\DTOs\v1\BaseAbstractDto;

class CustomerCreateDto extends BaseAbstractDto
{


    private $nit;
    private $business_entity_id;
    private $person_id;

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
            'person_id' => 'required',
        ];

    }

    protected function map(array $data): bool
    {
        $this->nit = $data['nit'];
        $this->business_entity_id = $data['business_entity_id'];
        $this->person_id = $data['person_id'];

        return true;
    }
}
