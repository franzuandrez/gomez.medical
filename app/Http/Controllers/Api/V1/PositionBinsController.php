<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PositionBinsResource;
use App\Models\Bin;
use Illuminate\Http\Request;

class PositionBinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($position_id)
    {
        //

        $bins = Bin::where('position_id', $position_id)->get();

        return PositionBinsResource::collection($bins);


    }

}
