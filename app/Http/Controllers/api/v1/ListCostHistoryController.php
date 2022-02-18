<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ListCostHistoryCollectionResource;
use App\Models\ProductCostHistory;
use Illuminate\Http\Request;

class ListCostHistoryController extends Controller
{
    //

    public function index($id)
    {
        //

        $prices = ProductCostHistory::whereProductId($id)
            ->orderBy('createdAt','desc')
            ->paginate(15);


        return ListCostHistoryCollectionResource::collection($prices);

    }

}
