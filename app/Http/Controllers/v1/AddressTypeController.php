<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\AddressTypeResource;
use App\Models\AddressType;
use Illuminate\Http\Request;

class AddressTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $addressTypes = AddressType::all();

        return AddressTypeResource::collection($addressTypes);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddressType  $addressType
     * @return \Illuminate\Http\Response
     */
    public function show(AddressType $addressType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddressType  $addressType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddressType $addressType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddressType  $addressType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddressType $addressType)
    {
        //
    }
}
