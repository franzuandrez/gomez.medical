<?php

namespace App\DTOs\v1\CashControlRegister;

use App\DTOs\v1\BaseAbstractDto;

class ControlCashRegisterDetailStartDto extends BaseAbstractDto
{


    private $detail;
    private $header_id;

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
    public function getDetail()
    {
        return $this->detail;
    }


    protected function configureValidatorRules(): array
    {
        return [
            'header_id' => 'required',
            'detail.*.payment_type_id' => 'required',
            'detail.*.start_value' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->detail = $data['detail'];
        $this->header_id = $data['header_id'];

        return true;
    }
}
