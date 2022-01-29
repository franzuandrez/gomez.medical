<?php

namespace App\Services\v1\Product;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Product\ProductNewStandardCostDto;
use App\Models\ProductCostHistory;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use InvalidArgumentException;

class ProductNewStandardCostService implements ServiceInterface
{

    private $dto;

    public function __construct(ProductNewStandardCostDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof ProductNewStandardCostDto) {
            throw new InvalidArgumentException('ProductNewStandardCostService needs to receive a ProductNewStandardCostDto');
        }
        return new ProductNewStandardCostService($dto);
    }

    public function execute()
    {

        $last_cost = 0;
        $response = null;
        $previous_cost = ProductCostHistory::where('product_id', $this->dto->getProductId)
            ->orderBy('product_cost_id', 'desc')
            ->first();

        if ($previous_cost) {
            $last_cost = $previous_cost->standard_cost;
            $previous_cost->end_date = Carbon::now();
            $previous_cost->save();
            $response = $previous_cost;
        }

        if ($last_cost <> $this->dto->getStandardCost()) {
            $newStandardCost = new ProductCostHistory();
            $newStandardCost->start_date = Carbon::now();
            $newStandardCost->product_id = $this->dto->getProductId();
            $newStandardCost->standard_cost = $this->dto->getStandardCost();;
            $newStandardCost->save();
            $response = $newStandardCost;
        }

        return $response->toArray();


    }
}
