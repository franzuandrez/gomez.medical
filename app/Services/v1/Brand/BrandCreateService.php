<?php

namespace App\Services\v1\Brand;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Brand\BrandCreateDto;
use App\Models\Brand;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class BrandCreateService implements ServiceInterface
{


    private $dto;


    public function __construct(BrandCreateDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof BrandCreateDto) {
            throw new InvalidArgumentException(
                'BrandCreateService needs to receive a BrandCreateDto.'
            );
        }
        return new BrandCreateService($dto);
    }

    public function execute()
    {

        $brand = new Brand();
        $brand->name = $this->dto->getName();
        $brand->save();

        return $brand->toArray();

    }

}
