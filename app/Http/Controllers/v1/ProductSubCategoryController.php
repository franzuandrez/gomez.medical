<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\ProductSubCategoryResource;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    //


    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {


        $q = $request->get('query');

        $subcategories = ProductSubcategory::select('product_subcategory.*')
        ->where(function ($query) use ($q) {
            return $query->orWhere('product_subcategory.name', 'LIKE', '%' . $q . '%')
                ->orWhere('product_category.name', 'LIKE', '%' . $q . '%');
        })
            ->join('product_category','product_category.product_category_id','=','product_subcategory.product_category_id')
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
