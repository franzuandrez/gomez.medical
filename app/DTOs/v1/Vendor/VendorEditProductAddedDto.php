<?php


namespace App\DTOs\v1\Vendor;


use App\DTOs\v1\BaseAbstractDto;

class VendorEditProductAddedDto extends BaseAbstractDto
{


    private $cost;
    private $vendor_id;
    private $product_id;

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
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
    public function getProductId()
    {
        return $this->product_id;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'cost' => 'required',
            'vendor_id' => 'required',
            'product_id' => 'required'
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
