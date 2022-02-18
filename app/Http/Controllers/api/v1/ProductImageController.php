<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Product\ProductAddImagesDto;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Services\v1\Product\ProductAddImagesService;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    //

    public function store(Request $request)
    {
        $product = Product::find($request->get('product_id'));

        $images = array_key_exists('images', $request->allFiles()) ? $request->allFiles()['images'] : [];
        if (count($images) > 0) {

            $dto_images = new ProductAddImagesDto(
                [
                    'product_id' => $product->product_id,
                    'product_name' => $product->name,
                    'images' => $request->allFiles()['images'],
                ]
            );
            $product_images_service = ProductAddImagesService::make($dto_images);
            $product_images_service->execute();
        }

        return response($product->toArray(), 201);
    }

    public function destroy($id)
    {
        //TODO refactor into a service
        $image = ProductPhoto::findOrFail($id);
        $image->delete();

        $deleted = \Storage::disk('s3')->delete('products/' . $image->file_name);
        if ($deleted === TRUE) {
            return response($id, 202);
        }
        return response(["message" => "File not found"], 500);
    }

    public function destroy_many($id)
    {
        $product = Product::find($id);
        $images = $product->photos;
        $deleted = ProductPhoto::destroy($images->map(function ($item) {
            return $item->product_photo_id;
        }));

        if ($deleted) {
            \Storage::delete($images->map(function ($item) {
                return 'products/' . $item->file_name;
            }));
        }


        return response("", 202);

    }
}
