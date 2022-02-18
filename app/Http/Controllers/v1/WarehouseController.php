<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Resources\v1\WarehouseResource;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return WarehouseResource
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
     */
    public function show(Warehouse $warehouse): WarehouseResource
    {
        //
        return new WarehouseResource($warehouse);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Warehouse $warehouse
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //


        $warehouse->name = $request->get('name');
        $warehouse->update();


        return new WarehouseResource($warehouse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Warehouse $warehouse
     */
    public function destroy(Warehouse $warehouse)
    {
        //

        $warehouse->delete();

        return response('', 204);

    }
}
