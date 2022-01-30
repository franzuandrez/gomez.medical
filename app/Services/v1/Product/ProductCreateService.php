<?php


namespace App\Services\v1\Product;


use App\Models\Product;
use  App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Product\ProductCreateDto;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;


class ProductCreateService implements ServiceInterface
{


    private $dto;

    public function __construct(ProductCreateDto $dto)
    {


        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {


        if (!$dto instanceof ProductCreateDto) {
            throw new InvalidArgumentException(
                'ProductCreateService needs to receive a ProductCreateDto.'
            );
        }
        return new ProductCreateService($dto);
    }

    public function execute(): array
    {
        // TODO: Implement execute() method.


        $product = new Product();
        $product->sku = $this->dto->getSku();
        $product->code = $this->dto->getCode();
        $product->name = $this->dto->getName();
        $product->description = $this->dto->getDescription();
        $product->standard_cost = $this->dto->getCost();
        $product->list_price = $this->dto->getListPrice();
        $product->description = $this->dto->getDescription();
        $product->color = $this->dto->getColor();
        $product->size = $this->dto->getSize();
        $product->size_unit_measure_code = $this->dto->getSizeUnitMeasureCode();
        $product->product_subcategory_id = $this->dto->getProductSubcategoryId();
        $product->instructions = $this->dto->getInstructions();
        $product->brand_id = $this->dto->getBrandId();
        $product->weight = $this->dto->getWeight();
        $product->weight_unit_measure_code = $this->dto->getWeightUnitMeasureCode();
        $product->save();

        return $product->toArray();
    }
}
