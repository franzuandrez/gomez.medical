<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Vendor\VendorAddProductDto;
use App\DTOs\v1\Vendor\VendorEditProductAddedDto;
use App\Http\Controllers\Controller;
use App\Services\v1\Vendor\VendorEditProductAddedService;
use Illuminate\Http\Request;

class VendorProductsController extends Controller
{
    //


    public function store(Request $request, $vendor_id, $product_id)
    {


        $vendorProductDto = new VendorAddProductDto(
            [
                'cost' => $request->get('cost'),
                'vendor_id' => $vendor_id,
                'product_id' => $product_id
            ]
        );

        $service = VendorEditProductAddedService::make($vendorProductDto);
        return $service->execute();


    }


    public function update(Request $request, $vendor_id, $product_id)
    {


        $vendorProductDto = new VendorEditProductAddedDto(
            [
                'cost' => $request->get('cost'),
                'vendor_id' => $vendor_id,
                'product_id' => $product_id
            ]
        );

        $service = VendorEditProductAddedService::make($vendorProductDto);
        return $service->execute();

    }
}
