<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PurchaseDetailResource;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;

class PurchaseHeaderDetailController extends Controller
{
    //

    public function index(Request $request)
    {


        return  PurchaseDetailResource::collection(PurchaseOrderDetail::where('purchase_order_id', $request->get('purchase_order_id'))
            ->paginate(25));
    }


}
