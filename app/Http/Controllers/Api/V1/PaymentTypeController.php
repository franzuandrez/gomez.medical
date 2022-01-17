<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PaymentTypeCollectionResource;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentTypeController extends Controller
{
    //


    public function index(Request $request): AnonymousResourceCollection
    {

        $payments = PaymentType::paginate(10);


        return PaymentTypeCollectionResource::collection($payments);


    }
}
