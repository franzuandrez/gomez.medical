<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\VendorResource;

use App\Models\Vendor;
use App\DTOs\v1\Vendor\VendorEditDto;
use App\Services\v1\Vendor\VendorEditService;
use Illuminate\Http\Request;


class VendorController extends Controller
{
    //


    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $query = $request->get('query') === null ? '' : $request->get('query');

        $vendors = Vendor::where('name', 'like', '%' . $query . '%')
            ->orderBy('updatedAt', 'desc')
            ->paginate(15);


        return VendorResource::collection($vendors);

    }


    public function store(Request $request): VendorResource
    {


        $vendor = new Vendor();
        $vendor->name = $request->get('name');
        $vendor->url_web = $request->get('url_web');
        $vendor->save();

        return new VendorResource($vendor);

    }


    public function show($id): VendorResource
    {
        $vendor = Vendor::find($id);
        return new VendorResource($vendor);
    }

    public function update(Request $request, $id)
    {

        $values = $request->all();
        $values['vendor_id'] = $id;

        $vendorEditDto = new VendorEditDto(
            $values
        );

        $vendorEditService = VendorEditService::make($vendorEditDto);
        return $vendorEditService->execute();


    }

    public function destroy($id)
    {

        try {

            $vendor = Vendor::find($id);
            $vendor->delete();

            return response('', 204);

        } catch (\Exception $ex) {

            return response($ex->getMessage(), 500);
        }

    }
}
