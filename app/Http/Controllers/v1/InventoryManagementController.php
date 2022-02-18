<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\Inventory\InventoryManagementDetailNewDto;
use App\DTOs\v1\Inventory\InventoryManagementHeaderNewDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v2\PhysicalInventoryHeaderCollectionResource;
use App\Http\Resources\v2\PhysicalInventoryHeaderResource;
use App\Models\PhysicalInventoryHeader;
use App\Services\v1\Inventory\InventoryManagementDetailNewService;
use App\Services\v1\Inventory\InventoryManagementHeaderNewService;
use Illuminate\Http\Request;

class InventoryManagementController extends Controller
{
    //


    public function index()
    {


        $collection = PhysicalInventoryHeader::select(
            'id',
            'start_date',
            'end_date',
            'status',
            'type',
            'comments',
            'job_title',
            'first_name',
            'last_name'
        )
            ->join('employee', 'employee.employee_id', '=', 'physical_inventory_header.done_by')
            ->join('person', 'employee.business_entity_id', '=', 'person.business_entity_id')
            ->paginate(10);


        return PhysicalInventoryHeaderCollectionResource::collection($collection);

    }

    public function store(Request $request)
    {


        $values_header = $request->all();

        $header_dto = new InventoryManagementHeaderNewDto($values_header);
        $header_service = InventoryManagementHeaderNewService::make($header_dto);
        $header = $header_service->execute();

        $values_detail = $request->all();
        $values_detail['header_id'] = $header['id'];
        $detail_dto = new InventoryManagementDetailNewDto($values_detail);
        $detail_service = InventoryManagementDetailNewService::make($detail_dto);
        $detail_service->execute();


        return new PhysicalInventoryHeaderResource(PhysicalInventoryHeader::find($header['id']));


    }


    public function show($id)
    {

        $inventory = PhysicalInventoryHeader::findOrFail($id);

        return new PhysicalInventoryHeaderResource($inventory);

    }


}
