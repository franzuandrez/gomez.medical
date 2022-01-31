<?php

namespace App\DTOs\v1\Purchasing;

use App\DTOs\v1\BaseAbstractDto;

class PurchasingEditProductPriceDto extends BaseAbstractDto
{


    private $detail_id;
    private $new_price;

    /**
     * @return mixed
     */
    public function getDetailId()
    {
        return $this->detail_id;
    }

    /**
     * @return mixed
     */
    public function getNewPrice()
    {
        return $this->new_price;
    }


    protected function configureValidatorRules(): array
    {
        return [
            'detail_id' => 'required',
            'new_price' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->detail_id = $data['detail_id'];
        $this->new_price = $data['new_price'];
        return true;
    }
}
