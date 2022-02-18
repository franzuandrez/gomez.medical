<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\SalesOrderHeader;
use Illuminate\Http\Request;

class UnPaidSalesController extends Controller
{
    //


    public function update(Request $request, $id)
    {


        $sale = SalesOrderHeader::findOrFail($id);
        $sale->markAsPaid();


        return response()->json([
            'message' => 'paid successfully'
        ]);

    }
}
