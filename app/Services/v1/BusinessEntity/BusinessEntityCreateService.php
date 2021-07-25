<?php


namespace App\Services\v1\BusinessEntity;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\BusinessEntity\BusinessEntityCreateDto;
use App\Models\BusinessEntity;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class BusinessEntityCreateService implements ServiceInterface
{


    private $dto;

    public function __construct(BusinessEntityCreateDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {


        if (!$dto instanceof BusinessEntityCreateDto) {
            throw new InvalidArgumentException(
                'BusinessEntityCreateService needs to receive a BusinessEntityCreateDto.'
            );
        }

        return new BusinessEntityCreateService($dto);

    }

    public function execute()
    {


        $businessEntity = new BusinessEntity();
        $businessEntity->save();

        return $businessEntity->toArray();
    }
}
