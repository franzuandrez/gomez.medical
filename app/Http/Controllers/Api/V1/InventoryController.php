<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Inventory\InventoryAddDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\InventoryResource;
use App\Models\InventoryMovement;
use App\Services\v1\Inventory\InventoryAddService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return InventoryResource
     */
    public function store(Request $request): InventoryResource
    {
        //

        $values = $request->all();
        $inventoryAddDto = new InventoryAddDto(
            $values
        );
        $inventoryAddService = InventoryAddService::make($inventoryAddDto);
        $inventory = $inventoryAddService->execute();


        return new InventoryResource(InventoryMovement::find($inventory['id']));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
