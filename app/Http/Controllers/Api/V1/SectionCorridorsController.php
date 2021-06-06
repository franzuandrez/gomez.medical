<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\SectionCorridorsResource;
use App\Models\Corridor;
use Illuminate\Http\Request;

class SectionCorridorsController extends Controller
{
    //


    public function index($section_id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $corridors = Corridor::where('section_id', $section_id)->get();


        return SectionCorridorsResource::collection($corridors);



    }
}
