<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\RackResource;
use App\Models\Rack;
use App\Models\RackLevel;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class RackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        //

        return RackResource::collection(Rack::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RackResource
     */
    public function store(Request $request)
    {
        //
        $rack = new Rack();
        $rack->name = $request->get('name');
        $rack->corridor_id = $request->get('corridor_id');
        $rack->save();

        $levels_count = $request->get('levels_count');
        $positions_count = $request->get('positions_count');
        $level_available = range('A', 'Z');
        for ($i = 0; $i < $levels_count; $i++) {
            $level = new RackLevel();
            $level->name = $level_available[$i];
            $level->rack_id = $rack->rack_id;
            $level->save();
            for ($j = 0; $j < $positions_count; $j++) {
                $position = new Position();
                $position->name = $j + 1;
                $position->level_id = $level->level_id;
                $position->save();
            }
        }


        return new RackResource($rack);
    }

    /**
     * Display the specified resource.
     *
     * @param Rack $rack
     * @return RackResource
     */
    public function show(Rack $rack): RackResource
    {
        //
        return new RackResource($rack);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Rack $rack
     * @return RackResource
     */
    public function update(Request $request, Rack $rack): RackResource
    {
        //

        $rack->name = $request->get('name');
        $rack->corridor_id = $request->get('corridor_id');
        $rack->save();

        return new RackResource($rack);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rack $rack
     * @return Response
     */
    public function destroy(Rack $rack): Response
    {
        //
        try {

            $rack->delete();

            return response('', 204);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 500);
        }
    }
}
