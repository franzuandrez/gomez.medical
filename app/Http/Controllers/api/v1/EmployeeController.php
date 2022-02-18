<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\BusinessEntity\BusinessEntityCreateDto;
use App\DTOs\v1\Employee\EmployeeAddDto;
use App\DTOs\v1\Employee\EmployeeEditDto;
use App\DTOs\v1\Person\PersonCreateDto;
use App\DTOs\v1\Person\PersonEditDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\EmployeeCollectionResource;
use App\Http\Resources\v1\EmployeeResource;
use App\Models\Employee;
use App\Services\v1\BusinessEntity\BusinessEntityCreateService;
use App\Services\v1\Employee\EmployeeAddService;
use App\Services\v1\Employee\EmployeeEditService;
use App\Services\v1\Person\PersonCreateService;
use App\Services\v1\Person\PersonEditService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        //

        $query = $request->get('query');
        $employees = Employee::select(
            'employee.*',
            'person.*'
        )
            ->orWhere('person.first_name', 'LIKE', "%{$query}%")
            ->orWhere('person.last_name', 'LIKE', "%{$query}%")
            ->join('business_entity', 'business_entity.business_entity_id', '=', 'employee.business_entity_id')
            ->join('person', 'person.business_entity_id', '=', 'business_entity.business_entity_id')
            ->paginate(5);


        return EmployeeCollectionResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return EmployeeResource
     */
    public function store(Request $request)
    {
        //


        $businessEntityDto = new  BusinessEntityCreateDto([]);
        $businessEntityService = BusinessEntityCreateService::make($businessEntityDto);
        $businessEntity = $businessEntityService->execute();


        $personValues = $request->all();
        $personValues['business_entity_id'] = $businessEntity['business_entity_id'];
        $personValues['person_type'] = 'EM';
        $personCreateDto = new PersonCreateDto($personValues);
        $personCreatService = PersonCreateService::make($personCreateDto);
        $personCreatService->execute();


        $employeeValues = $request->all();
        $employeeValues['business_entity_id'] = $businessEntity['business_entity_id'];

        $employeeDto = new EmployeeAddDto($employeeValues);
        $employeeService = EmployeeAddService::make($employeeDto);
        $employee = $employeeService->execute();


        return new EmployeeResource(Employee::find($employee['employee_id']));


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return EmployeeResource
     */
    public function show($id)
    {

        return new EmployeeResource(Employee::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return EmployeeResource
     */
    public function update(Request $request, $id)
    {
        //


        $personValues = $request->all();
        $personCreateDto = new PersonEditDto($personValues);
        $personCreatService = PersonEditService::make($personCreateDto);
        $personCreatService->execute();


        $employeeValues = $request->all();
        $employeeValues['employee_id'] = $id;

        $employeeDto = new EmployeeEditDto($employeeValues);
        $employeeService = EmployeeEditService::make($employeeDto);
        $employeeService->execute();


        return new EmployeeResource(Employee::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
