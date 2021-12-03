<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PrintoutCollectionResource;
use App\Models\Printout;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PrintoutController extends Controller
{
    //

    private function clear($name)
    {

        $name = str_replace(['-', '+'], '', $name);
        $name = str_replace('Á', 'A', $name);
        $name = str_replace('á', 'a', $name);
        $name = str_replace('Ñ', 'N', $name);
        $name = str_replace('ñ', 'n', $name);
        $name = str_replace('É', 'E', $name);
        $name = str_replace('é', 'e', $name);
        $name = str_replace('Í', 'I', $name);
        $name = str_replace('í', 'i', $name);
        $name = str_replace('Ó', 'O', $name);
        $name = str_replace('ó', 'o', $name);
        $name = str_replace('Ú', 'U', $name);
        return str_replace('ú', 'u', $name);
    }




    public function show($id): AnonymousResourceCollection
    {


        $prints = Printout::select(
            'product.name',
            'product.description',
            'product.code',
            'product.sku',
            'printouts.quantity',
            'printouts.is_printed',
        )
            ->where('doc_id', $id)
            ->join('product', 'product.product_id', '=', 'printouts.product_id')
            ->paginate(15);

        return PrintoutCollectionResource::collection($prints);

    }
}
