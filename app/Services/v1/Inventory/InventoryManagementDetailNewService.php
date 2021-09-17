<?php

namespace App\Services\v1\Inventory;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Inventory\InventoryManagementDetailNewDto;
use App\Models\PhysicalInventoryDetail;
use App\Models\Product;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class InventoryManagementDetailNewService implements ServiceInterface
{


    private $dto;

    public function __construct(InventoryManagementDetailNewDto $dto)
    {

        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof InventoryManagementDetailNewDto) {
            throw new InvalidArgumentException(
                'InventoryManagementDetailNewService needs to receive a InventoryManagementDetailNewDto.'
            );
        }
        return new InventoryManagementDetailNewService($dto);
    }

    public function execute()
    {

        $detail_saved = collect([]);
        foreach ($this->dto->getProducts() as $product) {

            $detail = new PhysicalInventoryDetail();
            $productDB = Product::find($product['product_id']);
            $detail->header_id = $this->dto->getHeaderId();
            $detail->product_id = $product['product_id'];
            $detail->batch = $product['batch'];
            $detail->location_id = $product['bin_id'];
            $detail->system_quantity = $product['stock'];
            $detail->physical_quantity = $product['physical_quantity'];
            $detail->missing_quantity = intval($product['stock']) - intval($product['physical_quantity']);
            $detail->price = $productDB->currentPrice->list_price;
            $detail->total_system = intval($product['stock']) * $productDB->currentPrice->list_price;
            $detail->total_physical = intval($product['physical_quantity']) * $productDB->currentPrice->list_price;
            $detail->total_missing = intval($detail->missing_quantity) * $productDB->currentPrice->list_price;
            $detail->save();
            $detail_saved->push($detail);

        }


        return $detail->toArray();
    }
}
