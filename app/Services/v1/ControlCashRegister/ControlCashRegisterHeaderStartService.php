<?php

namespace App\Services\v1\ControlCashRegister;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\CashControlRegister\ControlCashRegisterHeaderStartDto;
use App\Models\ControlCashRegisterHeader;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;
class ControlCashRegisterHeaderStartService implements ServiceInterface
{


    private $dto;

    public function __construct(ControlCashRegisterHeaderStartDto $dto)
    {
        $this->dto = $dto;
    }


    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof ControlCashRegisterHeaderStartDto) {
            throw new InvalidArgumentException(
                'ControlCashRegisterHeaderStartService needs to receive a ControlCashRegisterHeaderStartDto.'
            );
        }
        return new ControlCashRegisterHeaderStartService($dto);
    }

    public function execute()
    {
        $control = new ControlCashRegisterHeader();
        $control->started_at = $this->dto->getStartedAt();
        $control->seller_id = $this->dto->getSellerId();
        $control->shift_id = $this->dto->getShiftId();
        $control->cash_register_id = $this->dto->getCashRegisterId();
        $control->status = 'iniciado';
        $control->save();


        return $control->toArray();
    }
}
