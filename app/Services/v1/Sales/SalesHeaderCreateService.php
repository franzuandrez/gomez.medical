<?php


namespace App\Services\v1\Sales;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\PayInPayOut\PayInPayOutCreateDto;
use App\DTOs\v1\Sales\SalesHeaderCreateDto;
use App\Models\Employee;
use App\Models\PaymentType;
use App\Models\SalesOrderHeader;
use App\Models\SalesPerson;
use App\Services\v1\PayInPayOut\PayInPayOutCreateService;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use InvalidArgumentException;
use Illuminate\Support\Str;

class SalesHeaderCreateService implements ServiceInterface
{


    private $dto;


    public function __construct(SalesHeaderCreateDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof SalesHeaderCreateDto) {
            throw new InvalidArgumentException(
                'SalesHeaderCreateService needs to receive a SalesHeaderCreateDto.'
            );
        }
        return new SalesHeaderCreateService($dto);
    }

    public function execute()
    {

        $sales_header = new SalesOrderHeader();

        $cash_register_id = 1;
        $sales_header->online_order_flag = $this->dto->getOnlineOrderFlag();
        $sales_header->order_date = Carbon::now();
        $sales_header->sales_order_number = Str::uuid()->toString();
        $sales_header->customer_id = $this->dto->getCustomerId();
        $sales_header->bill_to_address_id = $this->dto->getBillToAddressId();
        $sales_header->ship_to_address_id = $this->dto->getBillToAddressId();
        $sales_header->ship_method_id = $this->dto->getShipMethodId();
        $sales_header->payment_type = $this->dto->getPaymentType();
        $sales_header->subtotal = $this->dto->getSubtotal();
        $sales_header->freight = $this->dto->getFreight();
        $sales_header->total_due = $this->dto->getTotalDue();
        $sales_header->cash_register_id = $cash_register_id;// TODO get current cash register
        $sales_header->comments = $this->dto->getComments();
        $employee = Employee::whereLoginId(\Auth::id())->first();

        $sales_header->sales_person_id = SalesPerson::whereBusinessEntityId(
            $employee->business_entity_id
        )->first()->sales_person_id;
        $sales_header->save();
        if ($this->dto->getIsPaid()) {
            $sales_header->markAsPaid();
            $this->pay_in_pay_out_sale($sales_header, $employee);
        }
        $sales_header->markAsInProcess();


        return $sales_header->toArray();

    }


    private function pay_in_pay_out_sale($sale, $employee)
    {
        $pay_in_pay_out_values['doc_type'] = 'SALE';
        $pay_in_pay_out_values['doc_id'] = $sale->sales_order_id;
        $pay_in_pay_out_values['amount'] = $sale->total_due;
        $pay_in_pay_out_values['pay_date'] = $sale->order_date;
        $pay_in_pay_out_values['description'] = 'Venta generada';
        $pay_in_pay_out_values['comments'] = null;
        $pay_in_pay_out_values['factor'] = 1;
        $pay_in_pay_out_values['factor'] = 1;
        $pay_in_pay_out_values['cash_register_id'] = $sale->cash_register_id;
        $pay_in_pay_out_values['employee_id'] = $employee->employee_id;
        $pay_in_pay_out_values['payment_type_id'] = PaymentType::where('internal_code', $sale->payment_type)->first()->id;//TODO get id

        $dto = new PayInPayOutCreateDto($pay_in_pay_out_values);
        $service = PayInPayOutCreateService::make($dto);
        $service->execute();

    }

}
