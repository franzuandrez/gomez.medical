<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ListPriceHistoryCollectionResource;
use App\Models\ProductListPriceHistory;
use Illuminate\Http\Request;

class ListPriceHistoryController extends Controller
{

    public function index($id)
    {
        //

        $prices = ProductListPriceHistory::whereProductId($id)
            ->orderBy('createdAt','desc')
            ->paginate(15);


        return ListPriceHistoryCollectionResource::collection($prices);

    }

}
