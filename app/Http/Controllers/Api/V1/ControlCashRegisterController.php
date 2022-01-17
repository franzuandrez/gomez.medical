<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ControlCashRegisterHeaderResource;
use App\Http\Resources\v1\ControlCashHeaderCollectionResource;
use App\Http\Resources\v1\ControlCashRegisterDetailResource;
use App\Models\ControlCashRegisterHeader;
use App\Models\SalesOrderHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class ControlCashRegisterController extends Controller
{
    //


    public function index()
    {

        $controls = ControlCashRegisterHeader::select(
            'cash_register_control_header.*',
            'person.first_name as sales_person_first_name',
            'person.last_name as sales_person_last_name',
            'shift.name as shift_name',
            'cash_register.cash_register_number as cash_register',
        )
            ->join('shift', 'shift.shift_id', '=', 'cash_register_control_header.shift_id')
            ->join('cash_register', 'cash_register.id', '=', 'cash_register_control_header.cash_register_id')
            ->join('sales_person', 'sales_person.sales_person_id', '=', 'cash_register_control_header.seller_id')
            ->join('business_entity', 'business_entity.business_entity_id', '=', 'sales_person.business_entity_id')
            ->join('person', 'person.business_entity_id', '=', 'business_entity.business_entity_id')
            ->leftJoin('employee', 'employee.employee_id', '=', 'supervised_id')
            ->paginate(15);

        return ControlCashHeaderCollectionResource::collection($controls);
    }


    public function show($id)
    {

        $control = ControlCashRegisterHeader::find($id);

        $sales = [];
        if ($control->status == 'iniciado') {
            $sales = SalesOrderHeader::select('payment_type', DB::raw('sum(total_due) as total'))
                ->where('order_date', '>', $control->started_at)
                ->where('order_date', '<', Carbon::now())
                ->groupBy('payment_type')
                ->get();
        }


        return [
            'data' => [
                'control' => new ControlCashRegisterDetailResource($control) ,
                'sales' => $sales
            ]
        ];
    }
}
