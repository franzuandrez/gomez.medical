<?php

namespace App\Services\v1\Purchasing;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Purchasing\PurchaseHeaderFinishPriceEditionDto;
use App\Models\PurchaseOrderHeader;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PurchaseHeaderFinishPriceEditionService implements ServiceInterface
{


    private $dto;

    public function __construct(PurchaseHeaderFinishPriceEditionDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PurchaseHeaderFinishPriceEditionDto) {
            throw new InvalidArgumentException(
                'PurchaseHeaderFinishPriceEditionService needs to receive a PurchaseHeaderFinishPriceEditionDto.'
            );
        }
        return new PurchaseHeaderFinishPriceEditionService($dto);
    }

    public function execute()
    {
        $purchase = PurchaseOrderHeader::find($this->dto->getHeaderId());
        $purchase->needs_admin_verification = false;
        $purchase->save();
        return $purchase->toArray();
    }
}
