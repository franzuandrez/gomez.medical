<?php


namespace App\DTOs\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;


class PurchasingDetailCreateDto extends BaseAbstractDto
{


    private $products;
    private $purchase_order_id;

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getPurchaseOrderId()
    {
        return $this->purchase_order_id;
    }


    protected function configureValidatorRules(): array
    {


        return [
            'purchase_order_id' => 'required',
            'products.*.quantity' => 'required',
            'products.*.id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->products = $data['products'];
        $this->purchase_order_id = $data['purchase_order_id'];


        return true;


    }
}
