<?php

namespace App\DTOs\v1\Printout;

use App\DTOs\v1\BaseAbstractDto;

class PrintoutCreateDto extends BaseAbstractDto
{

    private $quantity;
    private $product_id;
    private $doc_id;
    private $comments;

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
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
    public function getDocId()
    {
        return $this->doc_id;
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
            'quantity' => 'required',
            'product_id' => 'required',
            'doc_id' => 'required',
            'comments' => 'required',

        ];
    }

    protected function map(array $data): bool
    {
        $this->quantity = $data['quantity'];
        $this->product_id = $data['quantity_printed'];
        $this->doc_id = $data['doc_id'];
        $this->comments = $data['comments'];

        return true;

    }
}
