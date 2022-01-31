<?php

namespace App\Services\v1\Purchasing;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Purchasing\PurchasingEditProductPriceDto;
use App\Models\PurchaseOrderDetail;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PurchasingEditProductPriceService implements ServiceInterface
{


    /**
     * @var PurchasingEditProductPriceDto
     */
    private $dto;

    public function __construct(PurchasingEditProductPriceDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof PurchasingEditProductPriceDto) {
            throw new InvalidArgumentException(
                'PurchasingEditProductPriceService needs to receive a PurchasingEditProductPriceDto.'
            );
        }
        return new PurchasingEditProductPriceService($dto);
    }

    public function execute()
    {
        $detail = PurchaseOrderDetail::find($this->dto->getDetailId());
        if ($detail->unit_price != $this->dto->getNewPrice()) {
            $detail->unit_price = $this->dto->getNewPrice();
            $detail->is_price_edited = 1;
            $detail->save();
        }


        return $detail->toArray();
    }
}
