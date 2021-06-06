<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BinResource;
use App\Models\Bin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        //
        return BinResource::collection(Bin::orderby('updatedAt', 'desc')->paginate(15));
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
        $bin = new Bin();
        $bin->position_id = $request->get('position_id');
        $bin->name = $request->get('name');
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
