<?php


namespace App\DTOs\v1\ShipMethod;


use App\DTOs\v1\BaseAbstractDto;

class ShipMethodCreateDto extends BaseAbstractDto
{


    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    protected function configureValidatorRules(): array
    {
        return [
            'name' => 'required'
        ];
    }

    protected function map(array $data): bool
    {


        $this->name = $data['name'];
        return true;
    }
}
