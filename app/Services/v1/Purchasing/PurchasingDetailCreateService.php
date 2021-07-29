<?php


namespace App\Services\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Purchasing\PurchasingDetailCreateDto;
use App\Models\Product;
use App\Models\PurchaseOrderDetail;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PurchasingDetailCreateService implements ServiceInterface
{


    private $dto;


    public function __construct(PurchasingDetailCreateDto $dto)
    {
        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PurchasingDetailCreateDto) {
            throw new InvalidArgumentException(
                'PurchasingDetailCreateService needs to receive a PurchasingDetailCreateDto.'
            );
        }
        return new PurchasingDetailCreateService($dto);
    }

    public function execute()
    {


        $order_detail = collect([]);
        $products = $this->dto->getProducts();
        foreach ($products as $key => $product) {
            $productDB = Product::find($product['id']);
            $detail = new PurchaseOrderDetail();
            $detail->product_id = $productDB->product_id;
            $detail->purchase_order_id = $this->dto->getPurchaseOrderId();
            $detail->order_quantity = $product['quantity'];
            $detail->received_quantity = 0;
            $detail->unit_price = $product['cost'];
            $detail->line_total = 0;
            $detail->rejected_quantity = 0;
            $detail->stocked_quantity = 0;
            $detail->save();
            $order_detail->push($detail);
        }

        return $order_detail->toArray();
    }
}
