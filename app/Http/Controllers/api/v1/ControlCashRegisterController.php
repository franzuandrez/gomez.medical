<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\CashControlRegister\ControlCashRegisterDetailEndDto;
use App\DTOs\v1\CashControlRegister\ControlCashRegisterDetailStartDto;
use App\DTOs\v1\CashControlRegister\ControlCashRegisterHeaderEndDto;
use App\DTOs\v1\CashControlRegister\ControlCashRegisterHeaderStartDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ControlCashRegisterHeaderResource;
use App\Http\Resources\v1\ControlCashHeaderCollectionResource;
use App\Models\ControlCashRegisterDetail;
use App\Models\ControlCashRegisterHeader;
use App\Models\SalesOrderHeader;
use App\Models\Shift;
use App\Services\v1\ControlCashRegister\ControlCashRegisterDetailEndService;
use App\Services\v1\ControlCashRegister\ControlCashRegisterDetailStartService;
use App\Services\v1\ControlCashRegister\ControlCashRegisterHeaderEndService;
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
            ->orderBy('started_at','desc')
            ->paginate(15);

        return ControlCashHeaderCollectionResource::collection($controls);
    }


    public function store(Request $request)
    {

        //TODO refactor
        $cash_register_id = 1;

        $can_start = !ControlCashRegisterHeader::where('cash_register_id', $cash_register_id)->where('status', 'iniciado')->exists();

        if (!$can_start) {
            return response(['message' => 'Caja ya iniciada'], 422);
        }

        $current_shift = Shift::where('end_time', '>', Carbon::now()->format('H:i:s'))
            ->where('start_time', '<', Carbon::now()->format('H:i:s'))
            ->first();

        if (!$current_shift) {
            return response(['message' => 'Turno no disponible en este horario'], 422);
        }
        $dtoHeaderValues = $request->all();
        $dtoHeaderValues['seller_id'] = \Auth::user()->employee->businessEntity->salesPerson->sales_person_id;
        $dtoHeaderValues['shift_id'] = $current_shift->shift_id;

        $dtoHeaderValues['cash_register_id'] = $cash_register_id;
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

    public function update(Request $request, $id): array
    {
        $dtoHeaderValues = $request->all();
        $dtoHeaderValues['id'] = $id;
        $dtoHeaderValues['ended_at'] = Carbon::now();
        $dtoHeaderValues['supervised_id'] = \Auth::user()->employee->employee_id;
        $controlHeaderDto = new ControlCashRegisterHeaderEndDto($dtoHeaderValues);
        $controlHeaderService = ControlCashRegisterHeaderEndService::make($controlHeaderDto);
        $control = $controlHeaderService->execute();

        $dtoDetailValues['detail'] = $request->get('detail');
        $controlDetailDto = new ControlCashRegisterDetailEndDto($dtoDetailValues);
        $controlDetailService = ControlCashRegisterDetailEndService::make($controlDetailDto);
        $controlDetailService->execute();


        return $this->show($id);
    }

    public function show($id)
    {

        $control = ControlCashRegisterHeader::find($id);
        $start_date = Carbon::today()->format('Y-m-d') . ' ' . $control->shift->start_time;
        $end_date = Carbon::today()->format('Y-m-d') . ' ' . $control->shift->end_time;

        $detail = ControlCashRegisterDetail::select
        (
            'payment_type.name',
            'cash_register_control_detail.*',
            DB::raw(
                "(select IFNULL(sum(amount),0) from
                           pay_in_pay_out
                    where  cash_register_id = {$control->cash_register_id}
                    and factor = 1
                    and pay_in_pay_out.payment_type_id = payment_type.id
                      and  pay_date between  '{$start_date}' and '{$end_date}') as income"
            ), DB::raw(
            "(select  IFNULL(sum(amount),0) from
                           pay_in_pay_out
                    where  cash_register_id = {$control->cash_register_id}
                      and factor = -1
                    and pay_in_pay_out.payment_type_id = payment_type.id
                      and  pay_date between  '{$start_date}' and '{$end_date}') as outcome"
        )
        )
            ->where('header_id', $control->id)
            ->join('payment_type', 'payment_type.id', '=', 'cash_register_control_detail.payment_type')
            ->get();


        return [
            'data' => [
                'control' => new ControlCashRegisterHeaderResource($control),
                'detail' => $detail
            ]
        ];
    }
}
