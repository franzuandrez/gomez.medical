<?php


namespace App\Services\v1\ShipMethod;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\ShipMethod\ShipMethodEditDto;
use App\Models\ShipMethod;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;


class ShipMethodEditService implements ServiceInterface
{


    private $dto;


    public function __construct(ShipMethodEditDto $dto)
    {

        $this->dto = $dto;


    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof ShipMethodEditDto) {
            throw new InvalidArgumentException(
                'ShipMethodEditService needs to receive a ShipMethodEditDto.'
            );
        }
        return new ShipMethodEditService($dto);
    }

    public function execute()
    {

        $shipMethod = ShipMethod::findOrFail($this->dto->getShipMethodId());
        $shipMethod->name = $this->dto->getName();
        $shipMethod->save();

        return $shipMethod->toArray();


    }
}
