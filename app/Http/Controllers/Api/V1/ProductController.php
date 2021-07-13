<?php

namespace App\Http\Controllers\api\v1;


use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductResource;
use App\Models\Product;
use App\Services\v1\DTOs\Product\ProductAddImagesDto;
use App\Services\v1\DTOs\Product\ProductCreateDto;
use App\Services\v1\DTOs\Product\ProductNewPriceListDto;
use App\Services\v1\Product\ProductAddImagesService;
use App\Services\v1\Product\ProductCreateService;
use App\Services\v1\Product\ProductNewPriceListService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        //

        $query = $request->get('query');
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('createdAt', 'desc')
            ->paginate(15);

        return ProductResource::collection($products);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        //


        $dto_product = new ProductCreateDto($request->all());


        $product_service = ProductCreateService::make($dto_product);
        $product = $product_service->execute();

        $dto_price_list = new ProductNewPriceListDto(
            [
                'list_price' => $request->get('price'),
                'product_id' => $product['product_id']
            ]
        );

        $product_price_list_service = ProductNewPriceListService::make($dto_price_list);
        $product_price_list_service->execute();


        $dto_images = new ProductAddImagesDto(
            [
                'product_id' => $product['product_id'],
                'product_name' => $product['name'],
                'images' => $request->allFiles()['images'],
            ]
        );
        $product_images_service = ProductAddImagesService::make($dto_images);
        $product_images_service->execute();


        return ($product);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
