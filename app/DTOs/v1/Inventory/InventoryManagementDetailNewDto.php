<?php

namespace App\DTOs\v1\Inventory;

use App\DTOs\v1\BaseAbstractDto;

class InventoryManagementDetailNewDto extends BaseAbstractDto
{


    private $products;
    private $header_id;

    /**
     * @return mixed
     */
    public function getHeaderId()
    {
        return $this->header_id;
    }

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
            'header_id' => 'required',
            'products.*.product_id' => 'required',
            'products.*.bin_id' => 'required',
            'products.*.batch' => 'required',
            'products.*.stock' => 'required',
            'products.*.physical_quantity' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->header_id = $data['header_id'];
        $this->products = $data['products'];

        return true;
    }
}
