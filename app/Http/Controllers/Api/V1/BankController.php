<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BankCollectionResource;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    //


    public function index()
    {
        $banks = Bank::paginate(10);



        return BankCollectionResource::collection($banks);

    }
}
