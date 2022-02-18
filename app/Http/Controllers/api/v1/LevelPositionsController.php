<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\LevelPositionsResource;
use App\Models\Position;
use Illuminate\Http\Request;

class LevelPositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($level_id)
    {
        //

        $positions = Position::where('level_id', $level_id)->get();


        return LevelPositionsResource::collection($positions);

    }


}
