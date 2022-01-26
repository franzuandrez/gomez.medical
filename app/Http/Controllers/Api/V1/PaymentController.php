<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PaymentCollectionResource;
use App\Models\PayInPayOut;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index()
    {
        $payments = PayInPayOut::select(
            'payment_type.id',
            'doc_type',
            'doc_id',
            'amount',
            'pay_date',
            'description',
            'comments',
            'payment_type.name'
        )
            ->join('payment_type', 'payment_type.id', '=', 'payment_type_id')
            ->paginate(10);
        return PaymentCollectionResource::collection($payments);
    }


}
