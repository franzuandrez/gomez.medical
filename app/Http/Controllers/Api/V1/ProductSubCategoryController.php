<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductSubCategoryResource;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    //


    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {


        $query = $request->get('query');

        $subcategories = ProductSubcategory::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('updatedAt', 'desc')
            ->paginate(15);


        return ProductSubCategoryResource::collection($subcategories);

    }


    public function store(Request $request): ProductSubCategoryResource
    {

        $subcategory = new ProductSubcategory();
        $subcategory->name = $request->get('name');
        $subcategory->product_category_id = $request->get('product_category_id');
        $subcategory->save();


        return new ProductSubCategoryResource($subcategory);
    }


    public function show($id): ProductSubCategoryResource
    {

        $subcategory = ProductSubcategory::findOrFail($id);


        return new ProductSubCategoryResource($subcategory);
    }

    public function update(Request $request, $id): ProductSubCategoryResource
    {


        $subcategory = ProductSubcategory::findOrFail($id);
        $subcategory->name = $request->get('name');
        $subcategory->product_category_id = $request->get('product_category_id');
        $subcategory->update();


        return new ProductSubCategoryResource($subcategory);
    }


    public function destroy($id)
    {
        try {

            $subcategory = ProductSubcategory::findOrFail($id);

            $subcategory->delete();

            return response("", 204);

        } catch (\Exception $exception) {

            return response($exception->getMessage(), 500);
        }

    }
}
