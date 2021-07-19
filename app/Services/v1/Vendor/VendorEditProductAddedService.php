<?php


namespace App\Services\v1\Vendor;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Vendor\VendorEditProductAddedDto;
use App\Models\ProductVendor;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class VendorEditProductAddedService implements ServiceInterface
{


    private $dto;

    public function __construct(VendorEditProductAddedDto $dto)
    {

        $this->dto = $dto;

    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof VendorEditProductAddedDto) {
            throw new InvalidArgumentException(
                'VendorEditProductAddedService needs to receive a VendorEditProductAddedDto.'
            );
        }
        return new VendorEditProductAddedService($dto);
    }

    public function execute()
    {

        $product_added = ProductVendor::where('vendor_id', $this->dto->getVendorId())
            ->where('product_id', $this->dto->getProductId())
            ->firstOrFail();


        $product_added->standard_price = $this->dto->getCost();
        $product_added->update();


        return $product_added->toArray();

    }
}
