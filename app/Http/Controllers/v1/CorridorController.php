<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\CorridorResource;
use App\Http\Resources\v2\SectionLocationResource;
use App\Models\Corridor;
use App\Models\SectionLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CorridorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        //


        return CorridorResource::collection(Corridor::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CorridorResource
     */
    public function store(Request $request): CorridorResource
    {
        //

        $corridor = new Corridor();
        $corridor->section_id = $request->get('section_id');
        $corridor->name = $request->get('name');
        $corridor->save();

        return new CorridorResource($corridor);
    }

    /**
     * Display the specified resource.
     *
     * @param Corridor $corridor
     * @return CorridorResource
     */
    public function show(Corridor $corridor): CorridorResource
    {
        //
        return new CorridorResource($corridor);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Corridor $corridor
     * @return CorridorResource
     */
    public function update(Request $request, Corridor $corridor): CorridorResource
    {
        //
        $corridor->section_id = $request->get('section_id');
        $corridor->name = $request->get('name');
        $corridor->save();

        return new CorridorResource($corridor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Corridor $corridor
     * @return Response
     */
    public function destroy(Corridor $corridor): Response
    {
        //
        try {

            $corridor->delete();

            return response('', 204);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 500);
        }
    }
}
