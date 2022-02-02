<?php

namespace App\Services\v1\Purchasing;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Purchasing\PurchasingMakePaymentDto;
use App\Models\PurchaseOrderHeader;
use App\Models\PurchasePayment;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use InvalidArgumentException;

class PurchasingMakePaymentService implements ServiceInterface
{


    private $dto;

    public function __construct(PurchasingMakePaymentDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PurchasingMakePaymentDto) {
            throw new InvalidArgumentException(
                'PurchasingMakePaymentService needs to receive a PurchasingMakePaymentDto.'
            );
        }
        return new PurchasingMakePaymentService($dto);
    }

    public function execute()
    {
        $purchase = PurchaseOrderHeader::find($this->dto->getPurchaseId());

        $response = [];
        if (!$purchase->is_paid) {
            $payment = new PurchasePayment();
            $payment->purchase_id = $purchase->purchase_order_id;
            $payment->amount = $this->dto->getAmount();
            $payment->payment_type_id = $this->dto->getPaymentTypeId();
            $payment->doc_number_reference = $this->dto->getDocNumberReference();
            $payment->observations = $this->dto->getObservations();
            $payment->payment_date = Carbon::now();
            $payment->employee_id = $this->dto->getEmployeeId();
            if ($purchase->total_paid + $this->dto->getAmount() == $purchase->subtotal) {
                $purchase->is_paid = 1;
            }
            $payment->save();
            $purchase->total_paid = $this->dto->getAmount();
            $purchase->save();
            $response = $payment->toArray();
        } else {
            throw new \Exception(" Factura ya cancelada");
        }

        return $response;

    }
}
