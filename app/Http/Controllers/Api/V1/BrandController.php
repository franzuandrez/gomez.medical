<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Brand\BrandCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BrandCollectionResource;
use App\Http\Resources\v1\BrandResource;
use App\Models\Brand;
use App\Services\v1\Brand\BrandCreateService;
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


    public function store(Request $request)
    {


        $brandDto = new BrandCreateDto($request->all());
        $brandService = BrandCreateService::make($brandDto);

        $brand = $brandService->execute();

        return new BrandResource(Brand::find($brand['brand_id']));


    }

}
