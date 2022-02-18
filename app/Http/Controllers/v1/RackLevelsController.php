<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\RackLevelsResource;
use App\Models\RackLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RackLevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $rack_id
     * @return AnonymousResourceCollection
     */
    public function index($rack_id): AnonymousResourceCollection
    {
        //

        $levels = RackLevel::where('rack_id', $rack_id)->get();
        return RackLevelsResource::collection($levels);
    }


}
