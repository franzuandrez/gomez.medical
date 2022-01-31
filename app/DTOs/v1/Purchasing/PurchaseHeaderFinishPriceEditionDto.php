<?php

namespace App\DTOs\v1\Purchasing;

use App\DTOs\v1\BaseAbstractDto;

class PurchaseHeaderFinishPriceEditionDto extends BaseAbstractDto
{


    private $header_id;

    /**
     * @return mixed
     */
    public function getHeaderId()
    {
        return $this->header_id;
    }


    protected function configureValidatorRules(): array
    {

        return ['header_id' => 'required'];
    }

    protected function map(array $data): bool
    {
        $this->header_id = $data['header_id'];

        return true;
    }
}
