<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Sales\SalesDetailCreateDto;
use App\DTOs\v1\Sales\SalesHeaderCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SalesCollectionResource;
use App\Http\Resources\v1\SalesResource;
use App\Models\SalesOrderHeader;
use App\Services\v1\Sales\SalesDetailCreateService;
use App\Services\v1\Sales\SalesHeaderCreateService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    //


    public function index(Request $request)
    {


        $sales = SalesOrderHeader::select(
            'sales_order_header.order_date',
            'sales_order_header.paid',
            'sales_order_header.total_due',
            'sales_order_header.status',
            'sales_order_header.sales_order_number',
            'person.first_name as customer_first_name',
            'person.last_name as customer_last_name',
            'customer.business_name as business_name',
            'customer.nit as nit',
            'address.*'
        )
            ->join('customer', 'customer.customer_id', '=', 'sales_order_header.customer_id')
            ->leftJoin('person', 'person.person_id', '=', 'customer.person_id')
            ->join('address', 'address.address_id', '=', 'sales_order_header.bill_to_address_id')
            ->orderBy('sales_order_header.order_date', 'desc')
            ->paginate(10);

        return SalesCollectionResource::collection($sales);

    }


    public function store(Request $request)
    {


        $header_values['is_paid'] = $request->get('payment') === 'cash';
        $header_values['customer_id'] = $request->get('customer')['customer_id'];
        $header_values['bill_to_address_id'] = $request->get('products')['billing']['address']['address_id'];
        $header_values['ship_to_address_id'] = $request->get('products')['billing']['address']['address_id'];
        $header_values['ship_method_id'] = 96;
        $header_values['subtotal'] = $request->get('products')['subtotal'];
        $header_values['total_due'] = $request->get('products')['total'];
        $header_values['payment_type'] = "cash";
        $header_values['online_order_flag'] = 0;
        $header_values['freight'] = $request->get('delivery');

        $header_dto = new SalesHeaderCreateDto($header_values);

        $header_service = SalesHeaderCreateService::make($header_dto);
        $header = $header_service->execute();

        $values_details['products'] = $request->get('products')['cart'];
        $values_details['sales_order_header_id'] = $header['sales_order_id'];
        $detail_dto = new SalesDetailCreateDto($values_details);
        $detail_service = SalesDetailCreateService::make($detail_dto);
        $detail_service->execute();


        return new SalesResource(SalesOrderHeader::find($header['sales_order_id']));


    }


    public function show($id): SalesResource
    {


        return new SalesResource(
            SalesOrderHeader::where('sales_order_number', $id)
            ->firstOrFail()
        );

    }


}
