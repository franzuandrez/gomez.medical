<?php


namespace App\DTOs\v1\Person;


use App\DTOs\v1\BaseAbstractDto;

class PersonCreateDto extends BaseAbstractDto
{


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
    public function getPersonType()
    {
        return $this->person_type;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    private $business_entity_id;
    private $person_type;
    private $title;
    private $first_name;
    private $middle_name;
    private $last_name;
    private $suffix;


    protected function configureValidatorRules(): array
    {
        return [
            'business_entity_id' => 'required',
            'person_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->business_entity_id = $data['business_entity_id'];
        $this->person_type = $data['person_type'];
        $this->title = $data['title'];
        $this->first_name = $data['first_name'];
        $this->middle_name = $data['middle_name'];
        $this->last_name = $data['last_name'];
        $this->suffix = $data['suffix'];
        return true;

    }
}
