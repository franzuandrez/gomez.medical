<?php


namespace App\DTOs\v1\ShipMethod;


use App\DTOs\v1\BaseAbstractDto;

class ShipMethodEditDto extends BaseAbstractDto
{


    private $name;
    private $ship_method_id;

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
    public function getShipMethodId()
    {
        return $this->ship_method_id;
    }


    protected function configureValidatorRules(): array
    {


        return [
            'name' => 'required',
            'ship_method_id' => 'required'
        ];

    }

    protected function map(array $data): bool
    {

        $this->name = $data['name'];
        $this->ship_method_id = $data['ship_method_id'];

        return true;

    }
}
