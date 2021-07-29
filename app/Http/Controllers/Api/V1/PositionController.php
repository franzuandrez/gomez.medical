<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        //
        return PositionResource::collection(Position::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PositionResource
     */
    public function store(Request $request): PositionResource
    {
        //
        $position = new Position();
        $position->name = $request->get('name');
        $position->level_id = $request->get('level_id');
        $position->save();


        return new PositionResource($position);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PositionResource
     */
    public function show(int $id): PositionResource
    {
        //
        $position = Position::find($id);

        return new PositionResource($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return PositionResource
     */
    public function update(Request $request, $id): PositionResource
    {
        //
        $position = Position::find($id);
        $position->name = $request->get('name');
        $position->level_id = $request->get('level_id');
        $position->save();


        return new PositionResource($position);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id): Response
    {
        //
        try {

            $position = Position::find($id);
            $position->delete();

            return response('', 204);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 500);
        }
    }
}
