<?php

namespace App\DTOs\v1\CashControlRegister;

use App\DTOs\v1\BaseAbstractDto;

class ControlCashRegisterDetailEndDto extends BaseAbstractDto
{


    private $detail;

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }



    protected function configureValidatorRules(): array
    {
        return [
            'detail.*.id' => 'required',
            'detail.*.total_system' => 'required',
            'detail.*.in_drawer' => 'required',
            'detail.*.counted' => 'required',
            'detail.*.difference' => 'required',
            'detail.*.cash_out' => 'required',
            'detail.*.new_start_value' => 'required',
        ];
    }

    protected function map(array $data): bool
    {
        $this->detail = $data['detail'];


        return true;
    }
}
