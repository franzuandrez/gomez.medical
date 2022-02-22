<?php

namespace App\DTOs\v1\QuotationPrice;

use App\DTOs\v1\BaseAbstractDto;

class QuotationPriceDetailDto extends BaseAbstractDto
{

    private $header_id;
    private $order_quantity;
    private $product_id;
    private $special_offer_id;
    private $unit_price;
    private $unit_price_discount;
    private $line_total;

    /**
     * @return mixed
     */
    public function getHeaderId()
    {
        return $this->header_id;
    }

    /**
     * @return mixed
     */
    public function getOrderQuantity()
    {
        return $this->order_quantity;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @return mixed
     */
    public function getSpecialOfferId()
    {
        return $this->special_offer_id;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * @return mixed
     */
    public function getUnitPriceDiscount()
    {
        return $this->unit_price_discount;
    }

    /**
     * @return mixed
     */
    public function getLineTotal()
    {
        return $this->line_total;
    }


    protected function configureValidatorRules(): array
    {
        return [
            'header_id' => 'required',
            'order_quantity' => 'required',
            'product_id' => 'required',
            'special_offer_id' => 'required',
            'unit_price' => 'required',
            'unit_price_discount' => 'required',
            'line_total' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->header_id = $data['header_id'];
        $this->order_quantity = $data['order_quantity'];
        $this->product_id = $data['product_id'];
        $this->special_offer_id = $data['special_offer_id'];
        $this->unit_price = $data['unit_price'];
        $this->unit_price_discount = $data['unit_price_discount'];
        $this->line_total = $data['line_total'];

        return true;
    }
}
