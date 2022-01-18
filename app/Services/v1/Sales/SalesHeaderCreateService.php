<?php


namespace App\Services\v1\Sales;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Sales\SalesHeaderCreateDto;
use App\Models\Employee;
use App\Models\SalesOrderHeader;
use App\Models\SalesPerson;
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
        $sales_header->cash_register_id = 1;// TODO get current cash register
        $sales_header->comments = $this->dto->getComments();
        $sales_header->sales_person_id = SalesPerson::whereBusinessEntityId(
            Employee::whereLoginId(\Auth::id())->first()->business_entity_id
        )->sales_person_id;
        $sales_header->save();
        if ($this->dto->getIsPaid()) {
            $sales_header->markAsPaid();
        }
        $sales_header->markAsInProcess();
        return $sales_header->toArray();

    }
}
