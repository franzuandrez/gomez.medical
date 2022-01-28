<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BrandCollectionResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BrandController extends Controller
{
    //


    public function index(Request $request): AnonymousResourceCollection
    {

        $brands = Brand::select('*')
            ->where('name', 'like', "%{$request->get('query')}%")
            ->paginate(10);

        return BrandCollectionResource::collection($brands);

    }
}
