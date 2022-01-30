<?php

namespace App\DTOs\v1\Product;

use App\DTOs\v1\BaseAbstractDto;

class ProductNewStandardCostDto extends BaseAbstractDto
{

    private $standard_cost;
    private $product_id;

    /**
     * @return mixed
     */
    public function getStandardCost()
    {
        return $this->standard_cost;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }


    protected function configureValidatorRules(): array
    {
        return [
            'product_id' => 'required',
            'standard_cost' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->product_id = $data['product_id'];
        $this->standard_cost = $data['standard_cost'];

        return true;
    }
}
