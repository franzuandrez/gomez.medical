<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\SectionCorridorsResource;
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
