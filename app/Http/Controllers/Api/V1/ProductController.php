<?php

namespace App\Http\Controllers\api\v1;


use App\DTOs\v1\Product\ProductNewStandardCostDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use App\DTOs\v1\Product\ProductAddImagesDto;
use App\DTOs\v1\Product\ProductCreateDto;
use App\DTOs\v1\Product\ProductEditDto;
use App\DTOs\v1\Product\ProductNewPriceListDto;
use App\Services\v1\Product\ProductAddImagesService;
use App\Services\v1\Product\ProductCreateService;
use App\Services\v1\Product\ProductEditService;
use App\Services\v1\Product\ProductNewPriceListService;
use App\Services\v1\Product\ProductNewStandardCostService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;


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

        $perPage = $request->get('perPage') ?? 15;
        $query = $request->get('query');

        $products = Product::
        orWhere('name', 'LIKE', '%' . $query . '%')
            ->orWhere('sku', '=', $query)
            ->orWhere('code', '=', $query)
            ->orderBy('createdAt', 'desc')
            ->paginate($perPage);

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

        $dto_cost = new ProductNewStandardCostDto([
            'standard_cost' => $request->get('cost'),
            'product_id' => $product['product_id']
        ]);
        $product_cost_service = ProductNewStandardCostService::make($dto_cost);
        $product_cost_service->execute();

        //TODO refactor validation

        $images = array_key_exists('images', $request->allFiles()) ? $request->allFiles()['images'] : [];
        if (count($images) > 0) {
            $dto_images = new ProductAddImagesDto(
                [
                    'product_id' => $product['product_id'],
                    'product_name' => $product['name'],
                    'images' => $request->allFiles()['images'],
                ]
            );
            $product_images_service = ProductAddImagesService::make($dto_images);
            $product_images_service->execute();
        }


        return ($product);

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return ProductResource
     */
    public function show($id): ProductResource
    {
        //
        $product = Product::find($id);
        return new ProductResource($product);

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


        $values = $request->all();

        $values['product_id'] = $id;
        $dto_product = new ProductEditDto(
            $values
        );


        $product_service = ProductEditService::make($dto_product);
        $product = $product_service->execute();

        $dto_price_list = new ProductNewPriceListDto(
            [
                'list_price' => $request->get('price'),
                'product_id' => $product['product_id']
            ]
        );

        $product_price_list_service = ProductNewPriceListService::make($dto_price_list);
        $product_price_list_service->execute();


        return ($product);

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
