<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\LabelTypeCollectionResource;
use App\Models\LabelType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LabelTypeController extends Controller
{
    //

    public function index(): AnonymousResourceCollection
    {

        $labels = LabelType::paginate(10);

        return LabelTypeCollectionResource::collection($labels);
    }
}
