<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\BusinessEntity\BusinessEntityAddBankAccountDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BusinessEntityBankAccountResource;
use App\Models\BusinessEntityBankAccount;
use App\Services\v1\BusinessEntity\BusinessEntityAddBankAccountService;
use Illuminate\Http\Request;

class BusinessEntityAddBankAccountController extends Controller
{
    //


    public function store(Request $request)
    {


        $dtoValues = $request->all();

        $businessEntityAddBankAccountDto = new BusinessEntityAddBankAccountDto($dtoValues);
        $businessEntityAddBankAccountService = BusinessEntityAddBankAccountService::make($businessEntityAddBankAccountDto);
        $bankAccount = $businessEntityAddBankAccountService->execute();


        return new BusinessEntityBankAccountResource(BusinessEntityBankAccount::find($bankAccount['id']));







    }
}
