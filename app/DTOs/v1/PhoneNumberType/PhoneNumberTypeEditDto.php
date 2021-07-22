<?php


namespace App\DTOs\v1\PhoneNumberType;


use App\DTOs\v1\BaseAbstractDto;

class PhoneNumberTypeEditDto extends BaseAbstractDto
{


    private $name;
    private $phone_number_type_id;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
            'name' => 'required',
            'phone_number_type_id' => 'required'
        ];
    }

    protected function map(array $data): bool
    {

        $this->name = $data['name'];
        $this->phone_number_type_id = $data['phone_number_type_id'];

        return true;
    }
}
