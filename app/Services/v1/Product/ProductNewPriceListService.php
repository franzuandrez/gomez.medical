<?php


namespace App\Services\v1\Product;


use App\Models\ProductListPriceHistory;
use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Product\ProductNewPriceListDto;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;

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
                'ProductNewPriceListService needs to receive a ProductNewPriceListDto.'
            );
        }
        return new ProductNewPriceListService($dto);
    }

    public function execute(): array
    {

        $last_price = 0;
        $response = null;
        $previous_list = ProductListPriceHistory::where('product_id', $this->dto->getProductId())
            ->orderBy('product_list_price_id', 'desc')
            ->first();
        if ($previous_list) {
            $last_price = $previous_list->list_price;
            $previous_list->end_date = Carbon::now();
            $previous_list->save();
            $response = $previous_list;
        }

        if ($last_price <> $this->dto->getListPrice()) {
            $list = new ProductListPriceHistory();
            $list->list_price = $this->dto->getListPrice();
            $list->product_id = $this->dto->getProductId();
            $list->start_date = Carbon::now();
            $list->save();
            $response = $list;
        }


        return $response->toArray();
    }
}
