<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\StockCollectionResource;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        //

        $query = $request->get('query') === null ? '' : $request->get('query');
        $stocks = InventoryMovement::select(
            'inventory.batch',
            'inventory.best_before',
            'bin.name as bin',
            'product.product_id',
            'product.sku',
            'product.code',
            'product.name',
            'product.description',
            'product.color',
            'product.size',
            'product_subcategory.name as subcategory',
            \DB::raw('sum(movement_type.factor * inventory.quantity) as stock')
        );

        if ($query) {
            $stocks = $stocks->orwhere('product.sku', '=', $query)
                ->orWhere('product.code', '=', $query)
                ->orWhere('product.name', 'LIKE', "%{$query}%");
        }
        $stocks = $stocks->join('movement_type', 'movement_type.movement_type_id', '=', 'inventory.movement_type_id')
            ->join('product', 'product.product_id', '=', 'inventory.product_id')
            ->join('product_subcategory', 'product_subcategory.product_subcategory_id', '=', 'product.product_subcategory_id')
            ->join('bin', 'bin.bin_id', '=', 'inventory.bin_id')
            ->orderBy('inventory.best_before', 'desc')
            ->groupBy('inventory.product_id')
            ->groupBy('inventory.batch')
            ->groupBy('bin.bin_id')
            ->paginate(5);


        return StockCollectionResource::collection($stocks);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
