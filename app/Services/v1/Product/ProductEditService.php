<?php


namespace App\Services\v1\Product;


use App\Models\Product;
use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Product\ProductEditDto;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;


class ProductEditService implements ServiceInterface
{


    private $dto;

    public function __construct(ProductEditDto $dto)
    {


        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {


        if (!$dto instanceof ProductEditDto) {
            throw new InvalidArgumentException(
                'ProductEditService needs to receive a ProductEditDto.'
            );
        }
        return new ProductEditService($dto);
    }

    public function execute(): array
    {


        $product = Product::find($this->dto->getProductId());
        $product->sku = $this->dto->getSku();
        $product->code = $this->dto->getCode();
        $product->name = $this->dto->getName();
        $product->description = $this->dto->getDescription();
        $product->color = $this->dto->getColor();
        $product->size = $this->dto->getSize();
        $product->weight = $this->dto->getWeight();
        $product->product_subcategory_id = $this->dto->getProductSubcategoryId();
        $product->instructions = $this->dto->getInstructions();
        $product->save();

        return $product->toArray();
    }
}
