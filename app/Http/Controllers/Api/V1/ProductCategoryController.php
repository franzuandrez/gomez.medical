<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductCategoryResource;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    //


    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {


        $categories = ProductCategory::orderBy('createdAt', 'desc')
            ->paginate(15);
        return ProductCategoryResource::collection($categories);

    }

    public function store(Request $request): ProductCategoryResource
    {


        $category = new ProductCategory();
        $category->name = $request->get('name');
        $category->save();

        return new ProductCategoryResource($category);

    }

    public function update(Request $request, $id): ProductCategory
    {
        $category = ProductCategory::findOrFail($id);
        $category->name = $request->get('name');
        $category->save();

        return new ProductCategoryResource($category);
    }


    public function show($id): ProductCategoryResource
    {
        $category = ProductCategory::findOrFail($id);
        return new ProductCategoryResource($category);

    }

    public function destroy($id)
    {
        try {

            $category = ProductCategory::findOrFail($id);

            $category->delete();

            return response("", 204);
        } catch (\Exception $exception) {

            return response($exception->getMessage(), 500);
        }


    }
}
