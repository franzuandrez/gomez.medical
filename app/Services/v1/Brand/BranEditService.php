<?php

namespace App\Services\v1\Brand;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Brand\BrandEditDto;
use App\Models\Brand;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class BranEditService implements ServiceInterface
{

    private $dto;


    public function __construct(BrandEditDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof BrandEditDto) {
            throw new InvalidArgumentException(
                'BranEditService needs to receive a BrandEditDto.'
            );
        }
        return new BranEditService($dto);
    }

    public function execute()
    {
        $brand = Brand::find($this->dto->getBrandId());
        $brand->name = $this->dto->getName();
        $brand->update();

        return $brand->toArray();
    }
}
