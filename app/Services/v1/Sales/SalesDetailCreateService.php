<?php


namespace App\Services\v1\Sales;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Inventory\InventoryMovementDto;
use App\DTOs\v1\Sales\SalesDetailCreateDto;
use App\Http\Resources\v2\InventoryResource;
use App\Models\Bin;
use App\Models\SalesOrderDetail;
use App\Models\Product;
use App\Services\v1\Inventory\InventoryMovementService;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class SalesDetailCreateService implements ServiceInterface
{


    private $dto;

    public function __construct(SalesDetailCreateDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof SalesDetailCreateDto) {
            throw new InvalidArgumentException(
                'SalesDetailCreateService needs to receive a SalesDetailCreateDto.'
            );
        }

        return new SalesDetailCreateService($dto);
    }

    public function execute()
    {

        $order_detail = collect([]);
        $products = $this->dto->getProducts();
        foreach ($products as $key => $product) {
            $productDB = Product::find($product['product_id']);
            $detail = new SalesOrderDetail();
            $detail->sales_order_header_id = $this->dto->getSalesOrderHeaderId();
            $detail->order_quantity = $product['quantity'];
            $detail->unit_price = $product['price'];
            $detail->unit_price_discount = 0;
            $detail->line_total = $product['quantity'] * $product['price'];
            $detail->product_id = $productDB->product_id;
            $detail->special_offer_id = 1;
            $detail->save();
            $order_detail->push($detail);
            $values['product_id'] = $product['product_id'];
            $values['batch'] = $product['batch'];
            $values['best_before'] = $product['best_before'];
            $values['quantity'] = $product['quantity'];
            $values['location_id'] = Bin::whereName($product['bin'])->first()->bin_id;
            $values['type_movement'] = 'sales';
            $inventoryAddDto = new InventoryMovementDto(
                $values
            );
            $inventoryAddService = InventoryMovementService::make($inventoryAddDto);
            $inventoryAddService->execute();


        }

        return $order_detail->toArray();
    }

}
