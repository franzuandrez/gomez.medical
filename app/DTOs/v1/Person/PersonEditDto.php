<?php

namespace App\DTOs\v1\Person;

use App\DTOs\v1\BaseAbstractDto;

class PersonEditDto extends BaseAbstractDto
{

    private $person_id;
    private $title;
    private $first_name;
    private $middle_name;
    private $last_name;
    private $suffix;

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



    protected function configureValidatorRules(): array
    {
        return [
            'person_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }

    protected function map(array $data): bool
    {
        $this->person_id = $data['person_id'];
        $this->title = $data['title'];
        $this->first_name = $data['first_name'];
        $this->middle_name = $data['middle_name'];
        $this->last_name = $data['last_name'];
        $this->suffix = $data['suffix'];
        return true;
    }
}
