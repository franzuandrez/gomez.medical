<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\StockCollectionResource;
use App\Http\Resources\v1\StockResource;
use App\Models\InventoryMovement;
use App\Repositories\v1\Interfaces\StockRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class StockController extends Controller
{

    private $stockRepository;

    public function __construct(StockRepositoryInterface $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

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
        $only_available_stock = $request->get('only_available_stock') == 1 || $request->get('only_available_stock') != null;

        $stocks = $this->stockRepository->getAll($query, $only_available_stock);


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
     * @param String $id
     * @return StockResource
     */
    public function show(String $id): StockResource
    {
        //

        $stock = $this->stockRepository->getOneById($id);

        return new StockResource($stock);


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
