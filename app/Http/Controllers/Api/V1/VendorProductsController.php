<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Vendor\VendorAddProductDto;
use App\DTOs\v1\Vendor\VendorDeleteProductAddedDto;
use App\DTOs\v1\Vendor\VendorEditProductAddedDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\VendorProductsResource;
use App\Models\ProductVendor;

use App\Services\v1\Vendor\VendorAddProductService;
use App\Services\v1\Vendor\VendorDeleteProductAddedService;
use App\Services\v1\Vendor\VendorEditProductAddedService;
use Illuminate\Http\Request;

class VendorProductsController extends Controller
{
    //


    public function index(Request $request, $vendor_id)
    {

        $products = ProductVendor::where('vendor_id', $vendor_id)
            ->get();


        return VendorProductsResource::collection($products);

    }

    public function store(Request $request, $vendor_id, $product_id)
    {


        $vendorProductDto = new VendorAddProductDto(
            [
                'cost' => $request->get('cost'),
                'vendor_id' => $vendor_id,
                'product_id' => $product_id
            ]
        );

        $service = VendorAddProductService::make($vendorProductDto);
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


    public function destroy(Request $request, $vendor_id, $product_id)
    {
        $vendorProductDto = new VendorDeleteProductAddedDto(
            [

                'vendor_id' => $vendor_id,
                'product_id' => $product_id
            ]
        );

        $service = VendorDeleteProductAddedService::make($vendorProductDto);
        $service->execute();
        return response()->json("", 204);


    }
}