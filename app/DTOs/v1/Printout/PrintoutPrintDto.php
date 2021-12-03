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
            'printouts.*.id' => 'required',
            'printouts.*.quantity_printed' => 'required',
            'printouts.*.printed_by' => 'required',
        ];

    }

    protected function map(array $data): bool
    {


        $this->printouts = $data['printouts'];

        return true;

    }
}
