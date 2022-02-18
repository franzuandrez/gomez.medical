<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\PurchaseDetailResource;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;

class PurchaseHeaderDetailController extends Controller
{
    //

    public function index(Request $request)
    {

        $detail = PurchaseOrderDetail::select('purchase_order_details.*')
            ->where('purchase_order_id', $request->get('purchase_order_id'))
            ->where(function ($query) use ($request) {
                return $query->orWhere('product.name', 'LIKE', "%{$request->get('query')}%")
                    ->orwhere('product.description', 'LIKE', "%{$request->get('query')}%")
                    ->orwhere('product.code', 'LIKE', "%{$request->get('query')}%")
                    ->orwhere('product.sku', 'LIKE', "%{$request->get('query')}%");
            })
            ->join('product', 'product.product_id', '=', 'purchase_order_details.product_id')
            ->paginate(25);

        return PurchaseDetailResource::collection($detail);
    }


}
