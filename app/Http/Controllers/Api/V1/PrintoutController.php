<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PrintoutCollectionResource;
use App\Models\Printout;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PrintoutController extends Controller
{
    //


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
            ->join('product','product.product_id','=','printouts.product_id')
            ->paginate(15);

        return   PrintoutCollectionResource::collection($prints);

    }
}
