<?php


namespace App\Services\v1\Product;


use App\Models\ProductListPriceHistory;
use App\Services\v1\DTOs\BaseAbstractDto;
use App\Services\v1\DTOs\Product\ProductNewPriceListDto;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;

class ProductNewPriceListService implements ServiceInterface
{


    private $dto;

    public function __construct(ProductNewPriceListDto $dto)
    {


        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof ProductNewPriceListDto) {
            throw new InvalidArgumentException(
                'ProductCreateService needs to receive a ProductCreateDto.'
            );
        }
        return new ProductNewPriceListService($dto);
    }

    public function execute(): array
    {
        $list = new ProductListPriceHistory();

        $list->list_price = $this->dto->getListPrice();
        $list->product_id = $this->dto->getProductId();
        $list->start_date = Carbon::now();
        $list->save();

        return $list->toArray();
    }
}
