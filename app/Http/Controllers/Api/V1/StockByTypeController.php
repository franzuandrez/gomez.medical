<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\StockCollectionResource;
use App\Repositories\v1\Interfaces\StockRepositoryInterface;
use Illuminate\Http\Request;

class StockByTypeController extends Controller
{
    //
    private $stockRepository;

    public function __construct(StockRepositoryInterface $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function index(Request $request)
    {
        $type = $request->get('type');
        $type_id = $request->get('type_id');

        $stocks = $this->stockRepository->getByType($type, $type_id);


        return StockCollectionResource::collection($stocks);
    }
}
