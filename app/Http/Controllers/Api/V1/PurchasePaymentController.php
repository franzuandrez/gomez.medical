<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Purchasing\PurchasingMakePaymentDto;
use App\Http\Controllers\Controller;
use App\Services\v1\Purchasing\PurchasingMakePaymentService;
use Exception;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    //


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
            return  response($ex->getMessage(), 500);
        }

    }
}
