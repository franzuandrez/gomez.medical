<?php


namespace App\DTOs\v1\Vendor;


use App\DTOs\v1\BaseAbstractDto;


class VendorAddProductDto extends BaseAbstractDto
{


    private $product_id;
    private $vendor_id;
    private $cost;

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @return mixed
     */
    public function getVendorId()
    {
        return $this->vendor_id;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'cost' => 'required',
            'product_id' => 'required',
            'vendor_id' => 'required',
        ];


    }

    protected function map(array $data): bool
    {


        $this->product_id = $data['product_id'];
        $this->vendor_id = $data['vendor_id'];
        $this->cost = $data['cost'];


        return true;


    }
}
