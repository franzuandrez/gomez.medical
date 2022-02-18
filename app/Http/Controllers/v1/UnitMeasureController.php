<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UnitMeasureCollectionResource;
use App\Models\UnitMeasure;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitMeasureController extends Controller
{
    //


    public function index(Request $request): AnonymousResourceCollection
    {

        $q = $request->get('query');
        $units = UnitMeasure::select('*')
            ->where(function ($query) use ($q) {
                return $query->orWhere('name', 'LIKE', "%{$q}%")
                    ->orWhere('unit_measure_code', 'LIKE', "%{$q}%");
            })
            ->paginate(10);


        return UnitMeasureCollectionResource::collection($units);
    }
}
