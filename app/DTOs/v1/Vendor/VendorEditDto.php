<?php


namespace App\DTOs\v1\Vendor;


use App\DTOs\v1\BaseAbstractDto;

class VendorEditDto extends BaseAbstractDto
{


    private $account_number;
    private $name;

    private $vendor_id;

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
    public function getUrlWeb()
    {
        return $this->url_web;
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
            'name' => 'required',
            'vendor_id' => 'required',
        ];


    }

    protected function map(array $data): bool
    {

        $this->name = $data['name'];
        $this->url_web = $data['url_web'];
        $this->vendor_id = $data['vendor_id'];

        return true;
    }
}
