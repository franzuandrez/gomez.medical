<?php

namespace App\DTOs\v1\CashControlRegister;

use App\DTOs\v1\BaseAbstractDto;

class ControlCashRegisterHeaderStartDto extends BaseAbstractDto
{


    private $started_at;
    private $seller_id;
    private $shift_id;
    private $cash_register_id;

    /**
     * @return mixed
     */
    public function getStartedAt()
    {
        return $this->started_at;
    }

    /**
     * @return mixed
     */
    public function getSellerId()
    {
        return $this->seller_id;
    }

    /**
     * @return mixed
     */
    public function getShiftId()
    {
        return $this->shift_id;
    }


    /**
     * @return mixed
     */
    public function getCashRegisterId()
    {
        return $this->cash_register_id;
    }

    protected function configureValidatorRules(): array
    {

        return [
            'started_at' => 'required',
            'seller_id' => 'required',
            'shift_id' => 'required',
            'cash_register_id' => 'required',

        ];
    }

    protected function map(array $data): bool
    {
        $this->started_at = $data['started_at'];
        $this->seller_id = $data['seller_id'];
        $this->shift_id = $data['shift_id'];
        $this->cash_register_id = $data['cash_register_id'];
        $this->detail = $data['detail'];

        return true;
    }
}
