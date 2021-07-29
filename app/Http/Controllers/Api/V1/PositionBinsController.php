<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PositionBinsResource;
use App\Models\Bin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PositionBinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index($position_id)
    {
        //

        $bins = Bin::where('position_id', $position_id)->get();

        return PositionBinsResource::collection($bins);


    }

}
