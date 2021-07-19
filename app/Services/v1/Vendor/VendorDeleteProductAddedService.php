<?php


namespace App\Services\v1\Vendor;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Vendor\VendorDeleteProductAddedDto;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;
use App\Models\ProductVendor;

class VendorDeleteProductAddedService implements ServiceInterface
{


    private $dto;

    public function __construct(VendorDeleteProductAddedDto $dto)
    {

        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof VendorDeleteProductAddedDto) {
            throw new InvalidArgumentException(
                'VendorDeleteProductAddedService needs to receive a VendorDeleteProductAddedDto.'
            );
        }
        return new VendorDeleteProductAddedService($dto);
    }

    public function execute()
    {
        $product_added = ProductVendor::where('vendor_id', $this->dto->getVendorId())
            ->where('product_id', $this->dto->getProductId())
            ->firstOrFail();

        return $product_added->delete();

    }
}
