<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BinResource;
use App\Models\Bin;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        //
        $perPage = $request->get('per_page') === null ? 5 : $request->get('per_page');
        $query = $request->get('query') === null ? '' : $request->get('query');


        $bins = Bin::orderby('updatedAt', 'desc');
        if ($query) {
            $bins = $bins->where('name','like', "%$query%");
        }
        $bins = $bins->paginate($perPage);


        return BinResource::collection($bins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return BinResource
     */
    public function store(Request $request): BinResource
    {
        //

        $position = Position::find($request->get('position_id'));
        $bins = Bin::where('position_id', $position->position_id)->count() + 1;

        $name = $position->level->rack->corridor->name .
            $position->level->rack->name .
            $position->level->name .
            $position->name .
            '-' . $bins;
        $bin = new Bin();
        $bin->position_id = $request->get('position_id');
        $bin->name = $name;
        $bin->save();


        return new BinResource($bin);
    }

    /**
     * Display the specified resource.
     *
     * @param Bin $bin
     * @return BinResource
     */
    public function show(Bin $bin): BinResource
    {
        //

        return new BinResource($bin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bin $bin
     * @return BinResource
     */
    public function update(Request $request, Bin $bin): BinResource
    {
        //

        $bin->position_id = $request->get('position_id');
        $bin->name = $request->get('name');
        $bin->update();

        return new BinResource($bin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bin $bin
     * @return Response
     */
    public function destroy(Bin $bin): Response
    {
        //
        try {

            $bin->delete();

            return response('', 204);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 500);
        }
    }
}
