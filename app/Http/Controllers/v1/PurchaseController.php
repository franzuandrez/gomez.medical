<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\Purchasing\PurchasingDetailCreateDto;
use App\DTOs\v1\Purchasing\PurchasingDetailReceiveDto;
use App\DTOs\v1\Purchasing\PurchasingHeaderCreateDto;
use App\DTOs\v1\Purchasing\PurchasingHeaderReceiveDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PurchaseCollectionResource;
use App\Http\Resources\v1\PurchaseResource;
use App\Models\PurchaseOrderHeader;
use App\Services\v1\Purchasing\PurchasingDetailCreateService;
use App\Services\v1\Purchasing\PurchasingDetailReceiveService;
use App\Services\v1\Purchasing\PurchasingHeaderCreateService;
use App\Services\v1\Purchasing\PurchasingHeaderReceiveService;
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

        $status = $request->get('status');

        $purchases = PurchaseOrderHeader::select(
            'ship_method.name as ship_method',
            'vendor.name as vendor',
            'purchase_order_header.*',
        );

        if (!empty($status)) {
            $purchases = $purchases->where('status', $status);
        }
        $purchases = $purchases->leftJoin('ship_method', 'ship_method.ship_method_id', '=', 'purchase_order_header.ship_method_id')
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
                'employee_id' => '3101',
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
     * @return PurchaseResource
     */
    public function update(Request $request, $id)
    {
        //

        $values = $request->all();
        $values['purchase_order_id'] = $id;
        $dtoHeader = new PurchasingHeaderReceiveDto(
            $values
        );

        $serviceHeader = PurchasingHeaderReceiveService::make($dtoHeader);
        $serviceHeader->execute();

        $dtoDetail = new PurchasingDetailReceiveDto(
            ['products' => $request->get('products')]
        );
        $serviceDetail = PurchasingDetailReceiveService::make($dtoDetail);
        $serviceDetail->execute();

        return new PurchaseResource(PurchaseOrderHeader::find($id));

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
