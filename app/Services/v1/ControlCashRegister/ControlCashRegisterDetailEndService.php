<?php

namespace App\Services\v1\ControlCashRegister;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\CashControlRegister\ControlCashRegisterDetailEndDto;
use App\Models\ControlCashRegisterDetail;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class ControlCashRegisterDetailEndService implements ServiceInterface
{


    private $dto;

    public function __construct(ControlCashRegisterDetailEndDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof ControlCashRegisterDetailEndDto) {
            throw new InvalidArgumentException(
                'ControlCashRegisterDetailEndService needs to receive a ControlCashRegisterDetailEndDto.'
            );
        }
        return new ControlCashRegisterDetailEndService($dto);
    }

    public function execute()
    {

        $detail = $this->dto->getDetail();
        $result = collect([]);
        foreach ($detail as $det) {

            $detDB = ControlCashRegisterDetail::find($det['id']);
            $detDB->total_system = $det['total_system'];
            $detDB->in_drawer = $det['in_drawer'];
            $detDB->counted = $det['counted'];
            $detDB->difference = $det['difference'];
            $detDB->cash_out = $det['cash_out'];
            $detDB->new_start_value = $det['new_start_value'];
            $detDB->update();
            $result->push($detDB);
        }

        return $result->toArray();
    }
}
