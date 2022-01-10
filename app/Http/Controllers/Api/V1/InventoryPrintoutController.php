<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PrintoutCollectionResource;
use App\Models\InventoryMovement;
use App\Models\Printout;
use Illuminate\Http\Request;

class InventoryPrintoutController extends Controller
{
    //


    public function index(Request $request)
    {

        $printouts = Printout::select(
            'printouts.id',
            'printouts.product_id',
            'product.name',
            'product.description',
            'product.code',
            'product.sku',
            'printouts.quantity',
            'printouts.quantity_printed',
            'printouts.printed_by',
            'printouts.is_printed',
        )->join(
            'inventory',
            'inventory.id',
            '=',
            'printouts.doc_id'
        )
            ->join('product', 'product.product_id', '=', 'printouts.product_id')
            ->where('printouts.comments', 'INVENTORY')
        ->paginate(15);

        return PrintoutCollectionResource::collection($printouts);


    }


}
