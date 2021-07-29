<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Purchasing\PurchasingDetailCreateDto;
use App\DTOs\v1\Purchasing\PurchasingHeaderCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PurchaseCollectionResource;
use App\Http\Resources\V1\PurchaseResource;
use App\Models\PurchaseOrderHeader;
use App\Services\v1\Purchasing\PurchasingDetailCreateService;
use App\Services\v1\Purchasing\PurchasingHeaderCreateService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        //

        $purchases = PurchaseOrderHeader::select(
            'ship_method.name as ship_method',
            'vendor.name as vendor',
            'purchase_order_header.*',
        )
            ->leftJoin('ship_method', 'ship_method.ship_method_id', '=', 'purchase_order_header.ship_method_id')
            ->join('vendor', 'vendor.vendor_id', '=', 'purchase_order_header.vendor_id')
            ->join('employee', 'employee.employee_id', '=', 'purchase_order_header.employee_id')
            ->orderBy('purchase_order_header.order_date', 'desc')
            ->paginate(15);


        return PurchaseCollectionResource::collection($purchases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PurchaseResource
     */
    public function store(Request $request)
    {
        //

        $headerDto = new  PurchasingHeaderCreateDto(
            [
                'vendor_id' => $request->get('vendor')['vendor_id'],
                'employee_id' => '3051',
            ]
        );
        $headerService = PurchasingHeaderCreateService::make($headerDto);
        $header = $headerService->execute();

        $detailDto = new PurchasingDetailCreateDto(
            [
                'products' => $request->get('products'),
                'purchase_order_id' => $header['purchase_order_id']

            ]
        );
        $detailService = PurchasingDetailCreateService::make($detailDto);
        $detailService->execute();

        return new PurchaseResource(PurchaseOrderHeader::find($header['purchase_order_id']));


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PurchaseResource
     */
    public function show(int $id)
    {

        return new PurchaseResource(PurchaseOrderHeader::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
