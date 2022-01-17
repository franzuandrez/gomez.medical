<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ControlCashHeaderCollectionResource;
use App\Models\ControlCashRegisterHeader;
use Illuminate\Http\Request;

class ControlCashRegisterController extends Controller
{
    //


    public function index()
    {

        $controls = ControlCashRegisterHeader::paginate(15);

        return ControlCashHeaderCollectionResource::collection($controls);
    }
}
