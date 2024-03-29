<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\Brand\BrandCreateDto;
use App\DTOs\v1\Brand\BrandEditDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v2\BrandCollectionResource;
use App\Http\Resources\v2\BrandResource;
use App\Models\Brand;
use App\Services\v1\Brand\BrandCreateService;
use App\Services\v1\Brand\BranEditService;
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


    public function show($id)
    {

        return new BrandResource(Brand::find($id));
    }

    public function store(Request $request)
    {


        $brandDto = new BrandCreateDto($request->all());
        $brandService = BrandCreateService::make($brandDto);

        $brand = $brandService->execute();

        return new BrandResource(Brand::find($brand['brand_id']));


    }

    public function update(Request $request, $id): BrandResource
    {

        $values = $request->all();
        $values['brand_id'] = $id;
        $brandDto = new BrandEditDto($values);
        $brandService = BranEditService::make($brandDto);

        $brand = $brandService->execute();

        return new BrandResource(Brand::find($brand['brand_id']));
    }

}
