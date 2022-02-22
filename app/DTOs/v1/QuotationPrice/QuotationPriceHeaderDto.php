<?php

namespace App\DTOs\v1\QuotationPrice;

use App\DTOs\v1\BaseAbstractDto;

class QuotationPriceHeaderDto extends BaseAbstractDto
{


    private $quotation_date;
    private $sales_person_id;
    private $subtotal;
    private $total;

    private $bill_to_address_id;
    private $comments;

    /**
     * @return mixed
     */
    public function getQuotationDate()
    {
        return $this->quotation_date;
    }

    /**
     * @return mixed
     */
    public function getSalesPersonId()
    {
        return $this->sales_person_id;
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
    public function getTotal()
    {
        return $this->total;
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
    public function getComments()
    {
        return $this->comments;
    }


    protected function configureValidatorRules(): array
    {


        return [
            'quotation_date' => 'required',
            'sales_person_id' => 'required',
            'subtotal' => 'required',
            'total' => 'required',
            'bill_to_address_id' => 'required',

        ];
    }

    protected function map(array $data): bool
    {

        $this->quotation_date = $data['quotation_date'];
        $this->sales_person_id = $data['sales_person_id'];
        $this->subtotal = $data['subtotal'];
        $this->total = $data['total'];
        $this->bill_to_address_id = $data['bill_to_address_id'];
        $this->comments = $data['comments'];

        return true;

    }
}
