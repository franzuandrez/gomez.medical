<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\CashControlRegister\ControlCashRegisterDetailStartDto;
use App\DTOs\v1\CashControlRegister\ControlCashRegisterHeaderStartDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ControlCashRegisterHeaderResource;
use App\Http\Resources\v1\ControlCashHeaderCollectionResource;
use App\Models\ControlCashRegisterHeader;
use App\Models\SalesOrderHeader;
use App\Models\Shift;
use App\Services\v1\ControlCashRegister\ControlCashRegisterDetailStartService;
use App\Services\v1\ControlCashRegister\ControlCashRegisterHeaderStartService;
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


    public function store(Request $request)
    {


        $dtoHeaderValues = $request->all();
        $dtoHeaderValues['seller_id'] = \Auth::user()->employee->businessEntity->salesPerson->sales_person_id;
        $dtoHeaderValues['shift_id'] = Shift::where('end_time', '>', Carbon::now()->format('H:i:s'))
            ->where('start_time', '<', Carbon::now()->format('H:i:s'))
            ->first()
            ->shift_id;
        $dtoHeaderValues['cash_register_id'] = 1;
        $dtoHeaderValues['started_at'] = Carbon::now();

        $controlHeaderDto = new ControlCashRegisterHeaderStartDto($dtoHeaderValues);
        $controlHeaderService = ControlCashRegisterHeaderStartService::make($controlHeaderDto);
        $control = $controlHeaderService->execute();

        $dtoDetailValues['detail'] = $request->get('detail');
        $dtoDetailValues['header_id'] = $control['id'];
        $controlDetailDto = new ControlCashRegisterDetailStartDto($dtoDetailValues);
        $controlDetailService = ControlCashRegisterDetailStartService::make($controlDetailDto);
        $controlDetailService->execute();


        return new ControlCashRegisterHeaderResource(ControlCashRegisterHeader::find($control['id']));
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
                'control' => new ControlCashRegisterHeaderResource($control),
                'sales' => $sales
            ]
        ];
    }
}
