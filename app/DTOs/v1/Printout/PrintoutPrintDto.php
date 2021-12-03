<?php

namespace App\DTOs\v1\Printout;

use App\DTOs\v1\BaseAbstractDto;

class PrintoutPrintDto extends BaseAbstractDto
{


    private $id;
    private $quantity_printed;
    private $printed_by;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getQuantityPrinted()
    {
        return $this->quantity_printed;
    }

    /**
     * @return mixed
     */
    public function getPrintedBy()
    {
        return $this->printed_by;
    }


    protected function configureValidatorRules(): array
    {

        return [
            'id' => 'required',
            'quantity_printed' => 'required',
            'printed_by' => 'required',
        ];

    }

    protected function map(array $data): bool
    {


        $this->id = $data['id'];
        $this->quantity_printed = $data['quantity_printed'];
        $this->printed_by = $data['printed_by'];

        return true;

    }
}
