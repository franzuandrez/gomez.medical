<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\PayInPayOut\PayInPayOutCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PaymentCollectionResource;
use App\Models\PayInPayOut;
use App\Services\v1\PayInPayOut\PayInPayOutCreateService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    //

    public function index()
    {
        $payments = PayInPayOut::select(
            'pay_in_pay_out.id',
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

    public function store(Request $request)
    {


        $pay_in_pay_out_values['doc_type'] = $request->get('doc_type');;
        $pay_in_pay_out_values['doc_id'] = 0;
        $pay_in_pay_out_values['amount'] = $request->get('amount');
        $pay_in_pay_out_values['pay_date'] = Carbon::now();
        $pay_in_pay_out_values['description'] = $request->get('description');
        $pay_in_pay_out_values['payment_type_id'] = $request->get('payment_type_id');//TODO get payment_type
        $pay_in_pay_out_values['comments'] = $request->get('comments');
        $pay_in_pay_out_values['factor'] = -1;
        $pay_in_pay_out_values['cash_register_id'] = 1;//TODO get cash_register;
        $pay_in_pay_out_values['employee_id'] = \Auth::user()->employee->employee_id;

        $dto = new PayInPayOutCreateDto($pay_in_pay_out_values);
        $service = PayInPayOutCreateService::make($dto);
        $service->execute();

        return response('', 201);


    }


}
