<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BusinessEntityAddressResource;
use App\Http\Resources\v1\BusinessEntityResource;
use App\Models\Address;
use App\Models\BusinessEntityAddress;
use Illuminate\Http\Request;

class BusinessEntityAddressController extends Controller
{
    //

    public function store(Request $request)
    {

        //TODO REFACTOR
        $address = new Address();
        $address->address_line_1 = $request->get('address_line_1');
        $address->address_line_2 = $request->get('address_line_2');
        $address->city = $request->get('city');
        $address->postal_code = $request->get('postal_code');
        $address->save();

        $businessEntityAddress = new BusinessEntityAddress();
        $businessEntityAddress->business_entity_id = $request->get('business_entity_id');
        $businessEntityAddress->address_id = $address->address_id;
        $businessEntityAddress->address_type_id = $request->get('address_type_id');
        $businessEntityAddress->save();

        return new BusinessEntityAddressResource($businessEntityAddress);


    }
}
