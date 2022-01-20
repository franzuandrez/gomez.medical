<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\BusinessEntity\BusinessEntityCreateDto;
use App\DTOs\v1\Customer\CustomerCreateDto;
use App\DTOs\v1\Person\PersonCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\BusinessEntityAddress;
use App\Models\Customer;
use App\Services\v1\BusinessEntity\BusinessEntityCreateService;
use App\Services\v1\Customer\CustomerCreateService;
use App\Services\v1\Person\PersonCreateService;

class CustomerGetDefaultController extends Controller
{
    //


    public function index()
    {
        // todo refactor
        $defaultCustomer = Customer::join('person', 'person.person_id', '=', 'customer.person_id')
            ->where('nit', 'CF')
            ->where('person.first_name', 'CONSUMIDOR')
            ->where('person.last_name', 'FINAL')
            ->first();


        if (null === $defaultCustomer) {

            $businessEntityDto = new  BusinessEntityCreateDto([]);
            $businessEntityService = BusinessEntityCreateService::make($businessEntityDto);
            $businessEntity = $businessEntityService->execute();

            $personValues['business_entity_id'] = $businessEntity['business_entity_id'];
            $personValues['person_type'] = 'IN';
            $personValues['first_name'] = 'CONSUMIDOR';
            $personValues['last_name'] = 'FINAL';
            $personValues['suffix'] = 'CF';
            $personValues['title'] = 'CF';
            $personValues['middle_name'] = 'CF';

            $personCreateDto = new PersonCreateDto($personValues);
            $personCreatService = PersonCreateService::make($personCreateDto);
            $person = $personCreatService->execute();

            $customerDto = new CustomerCreateDto(
                [
                    'person_id' => $person['person_id'],
                    'nit' => 'CF',
                    'business_entity_id' => $businessEntity['business_entity_id'],
                    'business_name' => 'CF',
                ]
            );
            $customerService = CustomerCreateService::make($customerDto);
            $customer = $customerService->execute();
            $defaultCustomer = Customer::find($customer['customer_id']);

            $address = new Address();
            $address->address_line_1 = 'CIUDAD';
            $address->address_line_2 = 'CIUDAD';
            $address->city = 'CIUDAD';
            $address->postal_code = 'CIUDAD';
            $address->save();

            $businessEntityAddress = new BusinessEntityAddress();
            $businessEntityAddress->business_entity_id = $businessEntity['business_entity_id'];
            $businessEntityAddress->address_id = $address->address_id;
            $businessEntityAddress->address_type_id = AddressType::first()->address_type_id;
            $businessEntityAddress->save();
        }


        return new CustomerResource($defaultCustomer);


    }
}
