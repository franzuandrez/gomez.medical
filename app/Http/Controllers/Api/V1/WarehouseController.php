<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWarehouseRequest;
use App\Http\Requests\v1\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\V1\WarehouseResource;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //


        return new WarehouseResource(Warehouse::orderby('updatedAt', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(WarehouseRequest $request)
    {
        //


        $warehouse = new Warehouse();
        $warehouse->name = $request->get('name');
        $warehouse->save();


        return new WarehouseResource($warehouse);

    }

    /**
     * Display the specified resource.
     *
     * @param Warehouse $warehouse
     * @return Response
     */
    public function show(Warehouse $warehouse)
    {
        //
        return new WarehouseResource($warehouse);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Warehouse $warehouse
     * @return Response
     */
    public function update(Request $request, Warehouse $warehouse): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Warehouse $warehouse
     * @return Response
     */
    public function destroy(Warehouse $warehouse): Response
    {
        //
    }
}
