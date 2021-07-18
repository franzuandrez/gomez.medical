<?php


namespace App\Services\v1\Vendor;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Vendor\VendorAddProductDto;
use App\Exceptions\VendorAddProductException;
use App\Services\v1\ServiceInterface;
use http\Exception\InvalidArgumentException;

class VendorAddProductService implements ServiceInterface
{


    private $dto;

    public function __construct(VendorAddProductDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof VendorAddProductDto) {
            throw new InvalidArgumentException(
                'VendorAddProductService needs to receive a VendorAddProductDto.'
            );
        }
        return new VendorAddProductService($dto);
    }

    public function execute()
    {
        $product = ProductVendor::where('vendor_id', $this->dto->getVendorId())
            ->where('product_id', $this->dto->getProductId())
            ->first();
        $is_added = !isset($product);
        if ($is_added) {
            throw new VendorAddProductException(
                'VendorEditService needs to receive a VendorEditDto.'
            );

        }
        $new_product = new ProductVendor();
        $new_product->vendor_id = $this->dto->getVendorId();
        $new_product->product_id = $this->dto->getProductId();
        $new_product->cost = $this->dto->getCost();
        $new_product->save();

    }
}
