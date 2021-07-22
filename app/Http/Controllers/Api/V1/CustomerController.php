<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\BusinessEntity\BusinessEntityCreateDto;
use App\DTOs\v1\Customer\CustomerCreateDto;
use App\DTOs\v1\Person\PersonCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CustomerResource;
use App\Models\Customer;
use App\Services\v1\BusinessEntity\BusinessEntityCreateService;
use App\Services\v1\Customer\CustomerCreateService;
use App\Services\v1\Person\PersonCreateService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //


    public function index(Request $request)
    {


        $query = $request->get('query');
        $sortField = $request->get('sortField') == null ? 'customer.updatedAt' : $request->get('sortField');
        $sortDirection = $request->get('sortDirection') == null ? 'desc' : $request->get('sortDirection');

        $customers = Customer::where('nit', 'like', '%' . $query . '%')
            ->join('person', 'person.person_id', '=', 'customer.person_id')
            ->orderBy($sortField, $sortDirection)
            ->paginate(10);


        return CustomerResource::collection($customers);


    }


    public function show($customer_id)
    {

        $customer = Customer::where('customer_id', $customer_id)
            ->join('person', 'person.person_id', '=', 'customer.person_id')
            ->first();


        return new CustomerResource($customer);

    }


    public function store(Request $request)
    {


        $businessEntityDto = new  BusinessEntityCreateDto([]);
        $businessEntityService = BusinessEntityCreateService::make($businessEntityDto);
        $businessEntity = $businessEntityService->execute();


        $personValues = $request->all();
        $personValues['business_entity_id'] = $businessEntity['business_entity_id'];
        $personValues['person_type'] = 'IN';

        $personCreateDto = new PersonCreateDto($personValues);
        $personCreatService = PersonCreateService::make($personCreateDto);
        $person = $personCreatService->execute();


        $customerDto = new CustomerCreateDto(
            [
                'person_id' => $person['person_id'],
                'nit' => $request->get('nit'),
                'business_entity_id' => $businessEntity['business_entity_id']
            ]
        );
        $customerService = CustomerCreateService::make($customerDto);
        return $customerService->execute();


    }
}
