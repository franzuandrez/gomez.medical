<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\PersonCollectionResource;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    //


    public function index(Request $request)
    {

        $q = $request->get('query');
        $people = Person::select(
            'person_type',
            'first_name',
            'last_name',
        )->where(function ($query) use ($q) {
            return $query->orWhere('first_name', 'LIKE', "%{$q}%")
                ->orWhere('last_name', 'LIKE', "%{$q}%");
        })->paginate(15);


        return PersonCollectionResource::collection($people);


    }
}
