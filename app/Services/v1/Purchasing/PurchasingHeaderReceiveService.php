<?php


namespace App\Services\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Purchasing\PurchasingHeaderReceiveDto;
use App\Models\PurchaseOrderHeader;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PurchasingHeaderReceiveService implements ServiceInterface
{


    private $dto;

    public function __construct(PurchasingHeaderReceiveDto $dto)
    {

        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof PurchasingHeaderReceiveDto) {
            throw new InvalidArgumentException(
                'PurchasingHeaderReceiveService needs to receive a PurchasingHeaderReceiveDto.'
            );
        }
        return new PurchasingHeaderReceiveService($dto);


    }

    public function execute()
    {

        $header = PurchaseOrderHeader::find($this->dto->getPurchaseOrderId());
        $header->ship_method_id = $this->dto->getShipMethodId();
        $header->subtotal = $this->dto->getSubtotal();
        $header->freight = $this->dto->getFreight();
        $header->total_due = $this->dto->getTotalDue();
        $header->status = 2;//RECEPCIONADA
        $header->update();
    }
}
