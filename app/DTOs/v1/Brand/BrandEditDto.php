<?php

namespace App\DTOs\v1\Brand;

use App\DTOs\v1\BaseAbstractDto;

class BrandEditDto extends BaseAbstractDto
{


    private $brand_id;
    private $name;

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

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
            'brand_id' => 'required',
            'name' => 'required'
        ];
    }

    protected function map(array $data): bool
    {

        $this->name = $data['name'];
        $this->brand_id = $data['brand_id'];
        return true;
    }
}
