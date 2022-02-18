<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\Purchasing\PurchasingMakePaymentDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PurchasePaymentCollectionResource;
use App\Models\PurchasePayment;
use App\Services\v1\Purchasing\PurchasingMakePaymentService;
use Exception;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    //


    public function index($id)
    {

        $payments = PurchasePayment::select(
            'purchase_order_payments.*',
            'person.first_name as employee_first_name',
            'person.last_name as employee_last_name',
            'payment_type.name as payment_type',
        )
            ->where('purchase_id', $id)
            ->join('payment_type', 'payment_type.id', '=', 'purchase_order_payments.payment_type_id')
            ->join('employee', 'employee.employee_id', '=', 'purchase_order_payments.employee_id')
            ->join('business_entity', 'business_entity.business_entity_id', '=', 'employee.business_entity_id')
            ->join('person', 'person.business_entity_id', '=', 'business_entity.business_entity_id')
            ->paginate(10);


        return PurchasePaymentCollectionResource::collection($payments);

    }


    public function store(Request $request)
    {

        try {
            $values = $request->all();
            $values['employee_id'] = \Auth::user()->employee->employee_id;
            $dto = new PurchasingMakePaymentDto($values);
            $service = PurchasingMakePaymentService::make($dto);
            $service->execute();
            return response("", 201);
        } catch (Exception $ex) {
            return response($ex->getMessage(), 500);
        }

    }
}
