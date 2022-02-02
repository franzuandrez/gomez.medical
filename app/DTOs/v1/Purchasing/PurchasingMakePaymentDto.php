<?php

namespace App\DTOs\v1\Purchasing;

use App\DTOs\v1\BaseAbstractDto;

class PurchasingMakePaymentDto extends BaseAbstractDto
{

    private $amount;
    private $doc_number_reference;
    private $observations;
    private $payment_type_id;
    private $purchase_id;
    private $employee_id;

    /**
     * @return mixed
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
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
    public function getDocNumberReference()
    {
        return $this->doc_number_reference;
    }

    /**
     * @return mixed
     */
    public function getObservations()
    {
        return $this->observations;
    }

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
    public function getPurchaseId()
    {
        return $this->purchase_id;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'purchase_id' => 'required',
            'payment_type_id' => 'required',
            'amount' => 'required',
            'doc_number_reference' => 'required',
            'employee_id' => 'required'
        ];
    }

    protected function map(array $data): bool
    {

        $this->purchase_id = $data['purchase_id'];
        $this->payment_type_id = $data['payment_type_id'];
        $this->amount = $data['amount'];
        $this->employee_id = $data['employee_id'];
        $this->doc_number_reference = $data['doc_number_reference'];
        $this->observations = $data['observations'];
        return true;
    }
}
