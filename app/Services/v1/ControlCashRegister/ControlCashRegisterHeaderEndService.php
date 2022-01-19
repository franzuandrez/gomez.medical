<?php

namespace App\Services\v1\ControlCashRegister;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\CashControlRegister\ControlCashRegisterHeaderEndDto;
use App\Models\ControlCashRegisterHeader;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use InvalidArgumentException;

class ControlCashRegisterHeaderEndService implements ServiceInterface
{


    private $dto;

    public function __construct(ControlCashRegisterHeaderEndDto $dto)
    {
        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof ControlCashRegisterHeaderEndDto) {
            throw new InvalidArgumentException(
                'ControlCashRegisterHeaderEndService needs to receive a ControlCashRegisterHeaderEndDto'
            );
        }
        return new ControlCashRegisterHeaderEndService($dto);
    }

    public function execute()
    {

        $header = ControlCashRegisterHeader::find($this->dto->getId());
        $header->ended_at = $this->dto->getEndedAt();
        $header->supervised_id = $this->dto->getSupervisedId();
        $header->status = 'finalizado';
        $header->save();

        return $header->toArray();

    }
}
