<?php

namespace App\Services\v1\PayInPayOut;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\PayInPayOut\PayInPayOutCreateDto;
use App\Models\PayInPayOut;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PayInPayOutCreateService implements ServiceInterface
{


    private $dto;

    public function __construct(PayInPayOutCreateDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PayInPayOutCreateDto) {
            throw new InvalidArgumentException(
                'PayInPayOutCreateService needs to receive a PayInPayOutCreateDto.'
            );
        }
        return new PayInPayOutCreateService($dto);
    }

    public function execute()
    {

        $payment = new PayInPayOut();
        $payment->doc_type = $this->dto->getDocType();
        $payment->doc_id = $this->dto->getDocId();
        $payment->payment_type_id = $this->dto->getPaymentTypeId();
        $payment->amount = $this->dto->getAmount();
        $payment->pay_date = $this->dto->getPayDate();
        $payment->factor = $this->dto->getFactor();
        $payment->description = $this->dto->getDescription();
        $payment->comments = $this->dto->getComments();
        $payment->employee_id = $this->dto->getEmployeeId();
        $payment->cash_register_id = $this->dto->getCashRegisterId();
        $payment->save();

    }
}
