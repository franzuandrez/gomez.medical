<?php


namespace App\DTOs\v1\Sales;


use App\DTOs\v1\BaseAbstractDto;

class SalesHeaderCreateDto extends BaseAbstractDto
{


    private $online_order_flag;
    private $status;
    private $customer_id;
    private $bill_to_address_id;
    private $ship_to_address_id;
    private $ship_method_id;
    private $payment_type;
    private $subtotal;
    private $freight;
    private $total_due;
    private $comments;
    private $is_paid;

    /**
     * @return mixed
     */
    public function getIsPaid()
    {
        return $this->is_paid;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getOnlineOrderFlag()
    {
        return $this->online_order_flag;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @return mixed
     */
    public function getBillToAddressId()
    {
        return $this->bill_to_address_id;
    }

    /**
     * @return mixed
     */
    public function getShipToAddressId()
    {
        return $this->ship_to_address_id;
    }

    /**
     * @return mixed
     */
    public function getShipMethodId()
    {
        return $this->ship_method_id;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * @return mixed
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @return mixed
     */
    public function getFreight()
    {
        return $this->freight;
    }

    /**
     * @return mixed
     */
    public function getTotalDue()
    {
        return $this->total_due;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'online_order_flag' => 'required',
            'customer_id' => 'required',
            'bill_to_address_id' => 'required',
            'ship_method_id' => 'required',
            'payment_type' => 'required',
            'subtotal' => 'required',
            'freight' => 'required',
            'total_due' => 'required',
            'is_paid' => 'required'
        ];

    }

    protected function map(array $data): bool
    {

        $this->online_order_flag = $data['online_order_flag'];
        $this->customer_id = $data['customer_id'];
        $this->bill_to_address_id = $data['bill_to_address_id'];
        $this->ship_method_id = $data['ship_method_id'];
        $this->payment_type = $data['payment_type'];
        $this->subtotal = $data['subtotal'];
        $this->total_due = $data['total_due'];
        $this->freight = $data['freight'];
        $this->is_paid = $data['is_paid'];
        return true;
    }
}
