<?php


namespace App\Services\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Purchasing\PurchasingDetailReceiveDto;
use App\Models\PurchaseOrderDetail;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PurchasingDetailReceiveService implements ServiceInterface
{


    private $dto;


    public function __construct(PurchasingDetailReceiveDto $dto)
    {

        $this->dto = $dto;

    }


    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PurchasingDetailReceiveDto) {
            throw new InvalidArgumentException(
                'PurchasingDetailReceiveService needs to receive a PurchasingDetailReceiveDto.'
            );
        }
        return new PurchasingDetailReceiveService($dto);
    }

    public function execute()
    {

        $products = $this->dto->getProducts();
        $order_detail = collect([]);

        foreach ($products as $key => $product) {
            $detail = PurchaseOrderDetail::find($product['id']);
            $detail->received_quantity = $product['received_quantity'] + $product['order_quantity'];
            $detail->unit_price = $product['unit_price'];
            $detail->line_total = $detail->received_quantity * $detail->unit_price;
            $detail->save();
            $order_detail->push($detail);
        }

        return $order_detail->toArray();
    }
}
