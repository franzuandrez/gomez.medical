<?php

namespace App\DTOs\v1\PayInPayOut;

use App\DTOs\v1\BaseAbstractDto;

class PayInPayOutCreateDto extends BaseAbstractDto
{


    private $doc_type;
    private $doc_id;
    private $amount;
    private $pay_date;
    private $description;
    private $comments;
    private $factor;
    private $cash_register_id;
    private $employee_id;
    private $payment_type_id;

    /**
     * @return mixed
     */
    public function getPaymentTypeId()
    {
        return $this->payment_type_id;
    }

    /**
     * @return mixed
     */
    public function getDocType()
    {
        return $this->doc_type;
    }

    /**
     * @return mixed
     */
    public function getDocId()
    {
        return $this->doc_id;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getPayDate()
    {
        return $this->pay_date;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * @return mixed
     */
    public function getCashRegisterId()
    {
        return $this->cash_register_id;
    }

    /**
     * @return mixed
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }


    protected function configureValidatorRules(): array
    {


        return [
            'doc_type' => 'required',
            'doc_id' => 'required',
            'amount' => 'required',
            'pay_date' => 'required',
            'description' => 'required',
            'payment_type_id' => 'required',
            'factor' => 'required',
            'employee_id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->doc_type = $data['doc_type'];
        $this->doc_id = $data['doc_id'];
        $this->amount = $data['amount'];
        $this->pay_date = $data['pay_date'];
        $this->description = $data['description'];
        $this->cash_register_id = $data['cash_register_id'];
        $this->comments = $data['comments'];
        $this->payment_type_id = $data['payment_type_id'];
        $this->factor = $data['factor'];
        $this->employee_id = $data['employee_id'];

        return true;
    }
}
