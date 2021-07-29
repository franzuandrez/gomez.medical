<?php


namespace App\DTOs\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;

class PurchasingHeaderReceiveDto extends BaseAbstractDto
{


    private $purchase_order_id;
    private $ship_method_id;
    private $subtotal;
    private $freight;
    private $total_due;

    /**
     * @return mixed
     */
    public function getPurchaseOrderId()
    {
        return $this->purchase_order_id;
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




    protected function configureValidatorRules(): array
    {

        return [
            'ship_method_id' => 'required',
            'subtotal' => 'required',
            'freight' => 'required',
            'total_due' => 'required',
            'purchase_order_id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {


        $this->ship_method_id = $data['ship_method_id'];
        $this->subtotal = $data['subtotal'];
        $this->freight = $data['freight'];
        $this->total_due = $data['total_due'];
        $this->purchase_order_id = $data['purchase_order_id'];

        return true;
    }
}
