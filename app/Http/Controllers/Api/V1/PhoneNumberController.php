<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Person\PersonPhoneCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PhoneNumberResource;
use App\Models\PersonPhone;
use App\Services\v1\Person\PersonPhoneCreateService;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $phoneDto = new PersonPhoneCreateDto($request->all());
        $phoneService = PersonPhoneCreateService::make($phoneDto);
        $phone = $phoneService->execute();



        return new PhoneNumberResource(PersonPhone::find($phone['person_phone_id']));


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
