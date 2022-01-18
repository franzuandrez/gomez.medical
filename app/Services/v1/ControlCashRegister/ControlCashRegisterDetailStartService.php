<?php

namespace App\Services\v1\ControlCashRegister;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\CashControlRegister\ControlCashRegisterDetailStartDto;
use App\Models\ControlCashRegisterDetail;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class ControlCashRegisterDetailStartService implements ServiceInterface
{


    private $dto;

    public function __construct(ControlCashRegisterDetailStartDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof ControlCashRegisterDetailStartDto) {
            throw new InvalidArgumentException(
                'ControlCashRegisterDetailStartService needs to receive a ControlCashRegisterDetailStartDto.'
            );
        }
        return new ControlCashRegisterDetailStartService($dto);
    }

    public function execute()
    {
        $detail = $this->dto->getDetail();
        $result = collect([]);
        foreach ($detail as $det) {
            $detailDB = new ControlCashRegisterDetail();
            $detailDB->payment_type = $det['payment_type_id'];
            $detailDB->start_value = $det['start_value'];
            $detailDB->header_id = $this->dto->getHeaderId();
            $detailDB->save();
            $result->push($detailDB);
        }

        return $result->toArray();

    }
}
