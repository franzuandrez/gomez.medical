<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SalesCollectionResource;
use App\Models\SalesOrderHeader;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    //


    public function index(Request $request)
    {

        $sales = SalesOrderHeader::select(
            'sales_order_header.order_date',
            'sales_order_header.paid',
            'sales_order_header.status',
            'sales_order_header.sales_order_number',
            'person.first_name as customer_first_name',
            'person.last_name as customer_last_name',
            'address.*'
        )
            ->join('customer', 'customer.customer_id', '=', 'sales_order_header.customer_id')
            ->join('person', 'person.person_id', '=', 'customer.person_id')
            ->join('address', 'address.address_id', '=', 'sales_order_header.bill_to_address_id')
            ->paginate(10);

        return SalesCollectionResource::collection($sales);

    }





}
