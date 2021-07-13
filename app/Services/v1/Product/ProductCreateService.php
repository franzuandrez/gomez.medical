<?php


namespace App\Services\v1\Product;


use App\Models\Product;
use App\Services\v1\DTOs\BaseAbstractDto;
use App\Services\v1\DTOs\Product\ProductCreateDto;
use App\Services\v1\ServiceInterface;

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
        $product->color = $this->dto->getColor();
        $product->size = $this->dto->getSize();
        $product->weight = $this->dto->getWeight();
        $product->product_subcategory_id = $this->dto->getProductSubcategoryId();
        $product->instructions = $this->dto->getInstructions();
        $product->save();

        return $product->toArray();
    }
}
