<?php


namespace App\DTOs\v1\Sales;


use App\DTOs\v1\BaseAbstractDto;

class SalesDetailCreateDto extends BaseAbstractDto
{


    private $products;
    private $sales_order_header_id;

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
    public function getSalesOrderHeaderId()
    {
        return $this->sales_order_header_id;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'sales_order_header_id' => 'required',
            'products.*.quantity' => 'required',
            'products.*.id' => 'required',
            'products.*.price' => 'required',
            'products.*.subtotal' => 'required',
        ];
    }

    protected function map(array $data): bool
    {


        $this->products = $data['products'];
        $this->sales_order_header_id = $data['sales_order_header_id'];

        return true;
    }
}
