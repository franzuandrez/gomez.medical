<?php


namespace App\DTOs\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;

class PurchasingHeaderReceiveDto extends BaseAbstractDto
{


    private $purchase_order_id;
    private $ship_method_id;
    private $subtotal;
    private $freight;


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





    protected function configureValidatorRules(): array
    {

        return [
            'ship_method_id' => 'required',
            'subTotal' => 'required',
            'freight' => 'required',
            'purchase_order_id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {


        $this->ship_method_id = $data['ship_method_id'];
        $this->subtotal = $data['subTotal'];
        $this->freight = $data['freight'];
        $this->purchase_order_id = $data['purchase_order_id'];

        return true;
    }
}
