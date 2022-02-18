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

        $customers = Customer::select(
            'customer.*',
            'person.person_id',
            'person.person_type',
            'person.title',
            'person.first_name',
            'person.middle_name',
            'person.last_name',
        )
            ->orWhere('nit', 'like', '%' . $query . '%')
            ->orWhere('business_name', 'like', "%$query%")
            ->orWhere('person.first_name', 'like', "%$query%")
            ->orWhere('person.last_name', 'like', "%$query%")
            ->leftjoin('person', 'person.person_id', '=', 'customer.person_id')
            ->orderBy($sortField, $sortDirection)
            ->paginate(10);


        return CustomerResource::collection($customers);


    }


    public function show($customer_id)
    {

        $customer = Customer::
        select(
            'customer.*',
            'person.person_id',
            'person.person_type',
            'person.title',
            'person.first_name',
            'person.middle_name',
            'person.last_name',
        )
            ->where('customer_id', $customer_id)
            ->leftJoin('person', 'person.person_id', '=', 'customer.person_id')
            ->first();


        return new CustomerResource($customer);

    }


    public function store(Request $request)
    {


        $businessEntityDto = new  BusinessEntityCreateDto([]);
        $businessEntityService = BusinessEntityCreateService::make($businessEntityDto);
        $businessEntity = $businessEntityService->execute();

        $person = null;
        if ($request->get('first_name')) {
            $personValues = $request->all();
            $personValues['business_entity_id'] = $businessEntity['business_entity_id'];
            $personValues['person_type'] = 'IN';
            $personCreateDto = new PersonCreateDto($personValues);
            $personCreatService = PersonCreateService::make($personCreateDto);
            $person = $personCreatService->execute();
        }


        $customerDto = new CustomerCreateDto(
            [
                'person_id' => $person ? $person['person_id'] : null,
                'nit' => $request->get('nit'),
                'business_entity_id' => $businessEntity['business_entity_id'],
                'business_name' => $request->get('business_name'),
            ]
        );
        $customerService = CustomerCreateService::make($customerDto);
        $customer = $customerService->execute();

        return new CustomerResource(Customer::find($customer['customer_id']));


    }
}
