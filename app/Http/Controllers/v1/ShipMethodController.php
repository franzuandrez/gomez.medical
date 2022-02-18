<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\ShipMethod\ShipMethodCreateDto;
use App\DTOs\v1\ShipMethod\ShipMethodEditDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ShipMethodCollectionResource;
use App\Http\Resources\v1\ShipMethodResource;
use App\Models\ShipMethod;
use App\Services\v1\ShipMethod\ShipMethodCreateService;
use App\Services\v1\ShipMethod\ShipMethodEditService;
use Illuminate\Http\Request;

class ShipMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        //

        $query = $request->get('query');

        $methods = ShipMethod::where('name', 'LIKE', '%' . $query . '%')
            ->paginate(15);


        return ShipMethodCollectionResource::collection($methods);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ShipMethodResource
     */
    public function store(Request $request): ShipMethodResource
    {
        //

        $shipMethodCreateDto = new ShipMethodCreateDto($request->all());
        $shipMethodCreateService = ShipMethodCreateService::make($shipMethodCreateDto);
        $method = $shipMethodCreateService->execute();

        return new ShipMethodResource(ShipMethod::find($method['ship_method_id']));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ShipMethodResource
     */
    public function show(int $id): ShipMethodResource
    {
        //

        return new ShipMethodResource(ShipMethod::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ShipMethodResource
     */
    public function update(Request $request, int $id): ShipMethodResource
    {
        //
        $values = $request->all();
        $values['ship_method_id'] = $id;
        $shipMethodDto = new ShipMethodEditDto($values);
        $shipMethodService = ShipMethodEditService::make($shipMethodDto);
        $method = $shipMethodService->execute();

        return new ShipMethodResource(ShipMethod::find($method['ship_method_id']));

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
