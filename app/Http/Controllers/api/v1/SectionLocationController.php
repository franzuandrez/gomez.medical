<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\SectionLocationResource;
use App\Http\Resources\v1\WarehouseResource;
use App\Models\SectionLocation;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class SectionLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        return SectionLocationResource::collection(SectionLocation::all());

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
        $section = new SectionLocation();
        $section->warehouse_id = $request->get('warehouse_id');
        $section->name = $request->get('name');
        $section->save();


        return new SectionLocationResource($section);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SectionLocation $section
     */
    public function show(SectionLocation $section): SectionLocationResource
    {
        //

        return new SectionLocationResource($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SectionLocation $section

     */
    public function update(Request $request, SectionLocation $section): SectionLocationResource
    {
        //
        $section->warehouse_id = $request->get('warehouse_id');
        $section->name = $request->get('name');
        $section->update();


        return new SectionLocationResource($section);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SectionLocation $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(SectionLocation $section)
    {
        //

        try {

            $section->delete();

            return response('', 204);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 500);
        }

    }
}
