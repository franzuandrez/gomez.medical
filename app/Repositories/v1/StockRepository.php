<?php

namespace App\Repositories\v1;

use App\Models\Bin;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\ProductSubcategory;
use App\Repositories\v1\Interfaces\StockRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class StockRepository implements StockRepositoryInterface
{


    public function getByType(string $type, string $type_id)
    {
        $stocks = $this->getQueryBuilder();

        if ($type === 'category') {

            $subcategories = ProductSubcategory::where('product_category_id', $type_id)->pluck('product_subcategory_id')->toArray();
            $products = Product::whereIn('product_subcategory_id', $subcategories)->pluck('product_id')->toArray();
            $stocks = $stocks->whereIn('product.product_id', $products);
        } elseif ($type === 'subcategory') {

            $products = Product::where('product_subcategory_id', $type_id)->pluck('product_id')->toArray();
            $stocks = $stocks->whereIn('product.product_id', $products);

        } elseif ($type === 'product') {

            $products = Product::orwhere('sku', $type_id)
                ->orwhere('code', $type_id)
                ->orwhere('product_id', $type_id)
                ->pluck('product_id')->toArray();
            $stocks = $stocks->whereIn('product.product_id', $products);

        } else {
            //by Location
            $bin = Bin::whereName($type_id)->first();
            $stocks = $stocks->where('inventory.bin_id', $bin ? $bin->bin_id : '');
        }


        return $stocks->get();
    }

    public function getAll(string $query, $only_available_stock, $perPage = 5)
    {
        $stocks = $this->getQueryBuilder();
        if ($query) {
            $stocks = $stocks
                ->orwhere('product.sku', '=', $query)
                ->orWhere('product.code', '=', $query)
                ->orWhere('bin.name', '=', $query)
                ->orWhere('product.name', 'LIKE', "%{$query}%");
        }

        if ($only_available_stock) {
            $stocks = $stocks->having('stock', '>', 0);
        }

        return $stocks->paginate($perPage);
    }


    public function getOneById(string $id)
    {
        $stocks = $this->getQueryBuilder();
        $id_parts = explode('|', $id);
        $stocks = $stocks->orWhere('product.product_id', '=', $id_parts[0])
            ->orWhere('bin.name', '=', $id_parts[1])
            ->orWhere('inventory.batch', '=', $id_parts[2]);

        return $stocks->firstOrFail();
    }

    private function getQueryBuilder(): Builder
    {
        return InventoryMovement::select(
            'inventory.batch',
            'inventory.best_before',
            'bin.name as bin',
            'bin.bin_id as bin_id',
            'product.product_id',
            'product.sku',
            'product.code',
            'product.name',
            'product.description',
            'product.color',
            'product.size',
            'product_subcategory.name as subcategory',
            \DB::raw('sum(movement_type.factor * inventory.quantity) as stock')
        )
            ->join('movement_type', 'movement_type.movement_type_id', '=', 'inventory.movement_type_id')
            ->join('product', 'product.product_id', '=', 'inventory.product_id')
            ->join('product_subcategory', 'product_subcategory.product_subcategory_id', '=', 'product.product_subcategory_id')
            ->join('bin', 'bin.bin_id', '=', 'inventory.bin_id')
            ->orderBy('inventory.best_before', 'asc')
            ->groupBy('inventory.product_id')
            ->groupBy('inventory.batch')
            ->groupBy('bin.bin_id');
    }
}
