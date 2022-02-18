<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\Employee\EmployeeAddUserDto;
use App\DTOs\v1\User\UserAddDto;
use App\DTOs\v1\User\UserEditDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use App\Services\v1\Employee\EmployeeAddUserService;
use App\Services\v1\User\UserAddService;
use App\Services\v1\User\UserEditService;
use Illuminate\Http\Request;

class UserController extends Controller
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
     */
    public function store(Request $request)
    {
        //


        //User
        $userValues = $request->all();
        $userValues['name'] = $request->get('username');
        $userDto = new UserAddDto($userValues);
        $userService = UserAddService::make($userDto);
        $user = $userService->execute();

        //Employee
        $employeeValues = $request->all();
        $employeeValues['login_id'] = $user['id'];
        $employeeDto = new  EmployeeAddUserDto($employeeValues);
        $employeeService = EmployeeAddUserService::make($employeeDto);
        $employeeService->execute();


        return new UserResource(User::find($user['id']));


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserResource
     */
    public function show($id)
    {
        //
        return new UserResource(User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return UserResource
     */
    public function update(Request $request, $id)
    {

        //User
        $userValues = $request->all();
        $userValues['name'] = $request->get('username');
        $userDto = new UserEditDto($userValues);
        $userService = UserEditService::make($userDto);
        $userService->execute();


        return new UserResource(User::find($id));

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
