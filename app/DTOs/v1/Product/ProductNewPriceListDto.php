<?php


namespace App\DTOs\v1\Product;


use App\DTOs\v1\BaseAbstractDto;

class ProductNewPriceListDto extends BaseAbstractDto
{


    private $list_price;
    private $product_id;



    protected function configureValidatorRules(): array
    {

        return [
            'list_price' => 'required',
            'product_id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {
        $this->list_price = $data['list_price'];
        $this->product_id = $data['product_id'];


        return true;
    }

    /**
     * @return mixed
     */
    public function getListPrice()
    {
        return $this->list_price;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }
}
