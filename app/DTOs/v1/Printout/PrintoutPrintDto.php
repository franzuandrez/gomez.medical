<?php

namespace App\DTOs\v1\Printout;

use App\DTOs\v1\BaseAbstractDto;

class PrintoutPrintDto extends BaseAbstractDto
{


    private $printouts;

    /**
     * @return mixed
     */
    public function getPrintouts()
    {
        return $this->printouts;
    }



    protected function configureValidatorRules(): array
    {

        return [
            'printouts.*.Id' => 'required',
            'printouts.*.Quantity_Printed' => 'required',
            'printouts.*.Printed_By' => 'required',
        ];

    }

    protected function map(array $data): bool
    {


        $this->printouts = $data['printouts'];

        return true;

    }
}
