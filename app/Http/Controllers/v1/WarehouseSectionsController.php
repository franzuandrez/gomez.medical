<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\SectionLocationResource;
use App\Http\Resources\v2\WarehouseSectionsResource;
use App\Models\SectionLocation;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseSectionsController extends Controller
{
    //


    public function index($warehouse_id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {


        $sections = Warehouse::find($warehouse_id)->sections;
        return WarehouseSectionsResource::collection($sections);
    }
}
