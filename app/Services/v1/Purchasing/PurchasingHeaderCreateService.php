<?php


namespace App\Services\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Purchasing\PurchasingHeaderCreateDto;
use App\Models\PurchaseOrderHeader;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use InvalidArgumentException;

class PurchasingHeaderCreateService implements ServiceInterface
{


    private $dto;

    public function __construct(PurchasingHeaderCreateDto $dto)
    {

        $this->dto = $dto;


    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PurchasingHeaderCreateDto) {
            throw new InvalidArgumentException(
                'PurchasingHeaderCreateService needs to receive a PurchasingHeaderCreateDto.'
            );
        }
        return new PurchasingHeaderCreateService($dto);
    }

    public function execute()
    {

        $purchase = new PurchaseOrderHeader();
        $purchase->status = 1;
        $purchase->employee_id = $this->dto->getEmployeeId();
        $purchase->vendor_id = $this->dto->getVendorId();
        $purchase->ship_method_id = null;
        $purchase->order_date = Carbon::now();
        $purchase->subtotal = 0;
        $purchase->tax_amount = 0;
        $purchase->freight = 0;
        $purchase->total_due = 0;
        $purchase->save();


        return $purchase->toArray();


    }
}
