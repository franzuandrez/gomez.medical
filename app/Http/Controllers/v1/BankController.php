<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BankCollectionResource;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    //


    public function index()
    {
        $banks = Bank::all();



        return BankCollectionResource::collection($banks);

    }
}
