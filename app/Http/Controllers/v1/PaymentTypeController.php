<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\PaymentTypeCollectionResource;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentTypeController extends Controller
{
    //


    public function index(Request $request): AnonymousResourceCollection
    {

        $payments = PaymentType::select('payment_type.*','payment_type.id as payment_type_id')->paginate(10);


        return PaymentTypeCollectionResource::collection($payments);


    }
}
