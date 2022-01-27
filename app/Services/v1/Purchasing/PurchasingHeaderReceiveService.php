<?php


namespace App\Services\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\PayInPayOut\PayInPayOutCreateDto;
use App\DTOs\v1\Purchasing\PurchasingHeaderReceiveDto;
use App\Models\PaymentType;
use App\Models\PurchaseOrderHeader;
use App\Services\v1\PayInPayOut\PayInPayOutCreateService;
use App\Services\v1\ServiceInterface;
use Illuminate\Support\Carbon;
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

        if ($header->freight > 0) {
            $this->pay_in_pay_out_shipping($header);
        }
        $header->total_due = $header->freight + $header->subtotal;
        $header->markAsReceived();
        $header->update();

        return $header->toArray();
    }


    private function pay_in_pay_out_shipping($purchase)
    {
        $pay_in_pay_out_values['doc_type'] = 'SHIPPING';
        $pay_in_pay_out_values['doc_id'] = $purchase->purchase_order_id;
        $pay_in_pay_out_values['amount'] = $purchase->freight;
        $pay_in_pay_out_values['pay_date'] = Carbon::now();
        $pay_in_pay_out_values['description'] = 'Pago de envio';
        $pay_in_pay_out_values['payment_type_id'] = PaymentType::where('internal_code', 'cash')->first()->id;//TODO get payment_type
        $pay_in_pay_out_values['comments'] = null;
        $pay_in_pay_out_values['factor'] = -1;
        $pay_in_pay_out_values['cash_register_id'] = 1;//TODO get cash_register;
        $pay_in_pay_out_values['employee_id'] = $purchase->employee_id;

        $dto = new PayInPayOutCreateDto($pay_in_pay_out_values);
        $service = PayInPayOutCreateService::make($dto);
        $service->execute();

    }
}
