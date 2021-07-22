<?php


namespace App\Services\v1\ShipMethod;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\ShipMethod\ShipMethodCreateDto;
use App\Models\ShipMethod;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class ShipMethodCreateService implements ServiceInterface
{


    private $dto;

    public function __construct(ShipMethodCreateDto $dto)
    {

        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof ShipMethodCreateDto) {
            throw new InvalidArgumentException(
                'ShipMethodCreateService needs to receive a ShipMethodCreateDto.'
            );
        }
        return new ShipMethodCreateService($dto);
    }

    public function execute()
    {

        $shipMethod = new ShipMethod();
        $shipMethod->name = $this->dto->getName();
        $shipMethod->save();

        return $shipMethod->toArray();
    }
}
