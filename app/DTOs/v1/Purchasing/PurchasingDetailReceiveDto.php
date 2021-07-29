<?php


namespace App\DTOs\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;

class PurchasingDetailReceiveDto extends BaseAbstractDto
{

    private $products;

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    protected function configureValidatorRules(): array
    {


        return [
            'products.*.id' => 'required',
            'products.*.order_quantity' => 'required',
            'products.*.order_quantity' => 'required',
            'products.*.received_quantity' => 'required',
            'products.*.unit_price' => 'required',

        ];

    }

    protected function map(array $data): bool
    {

        $this->products = $data['products'];

        return true;
    }
}
