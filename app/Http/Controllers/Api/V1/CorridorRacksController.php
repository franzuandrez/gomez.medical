<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CorridorRacksResource;
use App\Models\Rack;
use Illuminate\Http\Request;

class CorridorRacksController extends Controller
{
    //


    public function index($corridor_id)
    {

        $racks = Rack::where('corridor_id', $corridor_id)->get();

        return CorridorRacksResource::collection($racks);

    }
}
