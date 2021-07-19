<?php


namespace App\Services\v1\Vendor;


use App\Models\Vendor;
use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Vendor\VendorEditDto;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;


class VendorEditService implements ServiceInterface
{


    private $dto;

    public function __construct(VendorEditDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof VendorEditDto) {
            throw new InvalidArgumentException(
                'VendorEditService needs to receive a VendorEditDto.'
            );
        }
        return new VendorEditService($dto);

    }

    public function execute(): array
    {

        $vendor = Vendor::findOrFail($this->dto->getVendorId());
        $vendor->account_number = $this->dto->getAccountNumber();
        $vendor->name = $this->dto->getName();
        $vendor->url_web = $this->dto->getUrlWeb();
        $vendor->update();

        return $vendor->toArray();
    }
}
