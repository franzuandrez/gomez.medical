<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\LevelResource;
use App\Http\Resources\V1\RackResource;
use App\Models\RackLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        //


        return LevelResource::collection(RackLevel::paginate(15));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return LevelResource
     */
    public function store(Request $request): LevelResource
    {
        //

        $level = new RackLevel();
        $level->name = $request->get('name');
        $level->rack_id = $request->get('rack_id');
        $level->save();


        return new LevelResource($level);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return LevelResource
     */
    public function show(int $id): LevelResource
    {
        //

        return new LevelResource(RackLevel::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $level = RackLevel::find($id);
        $level->name = $request->get('name');
        $level->rack_id = $request->get('rack_id');
        $level->update();


        return new LevelResource($level);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        //
        try {

            $level = RackLevel::find($id);
            $level->delete();

            return response('', 204);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 500);
        }
    }
}
