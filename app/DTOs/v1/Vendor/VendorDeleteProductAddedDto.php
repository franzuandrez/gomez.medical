<?php


namespace App\DTOs\v1\Vendor;


use App\DTOs\v1\BaseAbstractDto;

class VendorDeleteProductAddedDto extends BaseAbstractDto
{


    private $vendor_id;
    private $product_id;

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
            'product_id' => 'required',
            'vendor_id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {
        $this->product_id = $data['product_id'];
        $this->vendor_id = $data['vendor_id'];


        return true;
    }
}
