<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseOrderHeader;
use App\Models\SalesOrderDetail;
use App\Models\SalesOrderHeader;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {


        $start_date = $request->get('start_date') === null ? Carbon::today() : Carbon::create($request->get('start_date'));
        $end_date = $request->get('end_date') === null ? Carbon::tomorrow()->subMilli() : $request->get('end_date');


        $salesToday = $this->sales($start_date, $end_date);

        $salesLast7Days = $this->sales($start_date->subDays(7), $end_date);
        $purchases = $this->purchases($start_date, $end_date);
        $salesGroupedByDay = $salesLast7Days
            ->map(function ($item) {
                return [
                    'sale' => $item,
                    'day' => $this->get_name_day($item->day)
                ];
            })
            ->groupBy('day');

        $totalProductsYesterday = 0;
        $totalSoldYesterday = 0;
        $totalCreditYesterday = 0;


        if ($salesGroupedByDay->count() > 1) {

            $salesYesterday = $salesGroupedByDay->values()->get(1)->pluck('sale');
            $salesDetailYesterday = $this->sales_detail($salesYesterday->pluck('sales_order_id')->toArray());
            $totalProductsYesterday = $salesDetailYesterday->sum('order_quantity');
            $totalSoldYesterday = $salesYesterday->where('paid', 1)->sum('total_due');
            $totalCreditYesterday = $salesYesterday->where('paid', 0)->sum('total_due');
        }

        $totalProducts7Days = $salesGroupedByDay->map(function ($item) {
            return
                $item->pluck('sale')->sum('total_products');
        });

        $totalSoldDays = $salesGroupedByDay
            ->map(function ($item) {
                return
                    $item->pluck('sale')->where('paid', 1)->sum('total_due');
            });
        $totalUnPaidDays = $salesGroupedByDay
            ->map(function ($item) {
                return
                    $item->pluck('sale')->where('paid', 0)->sum('total_due');
            });
        $salesDetailToday = $this->sales_detail($salesToday->pluck('sales_order_id')->toArray());


        $totalProducts = $salesDetailToday->sum('order_quantity');
        $totalSold = $salesToday->where('paid', 1)->sum('total_due');
        $totalCredit = $salesToday->where('paid', 0)->sum('total_due');
        $latestSoldProducts = $salesDetailToday->groupBy('product_id')
            ->map(function ($item) {
                return
                    $item->first();

            });

        $latestSales = $salesToday->where('paid', 1)->take(5);
        $latestCredits = $salesToday->where('paid', 0)->take(5);
        $latestPurchases = $purchases->take(5);


        $percentProducts = ($totalProducts - $totalProductsYesterday) / ($totalProductsYesterday ?: 1) * 100;
        $percentSold = ($totalSold - $totalSoldYesterday) / ($totalSoldYesterday ?: 1) * 100;
        $percentCredit = ($totalCredit - $totalCreditYesterday) / ($totalCreditYesterday ?: 1) * 100;
        $newProducts = Product::select(
            'product.name',
            \DB::raw('(Select path from product_photo where product_photo.product_id = product.product_id order by default_cover  desc  limit 1) as image')
        )
            ->join('inventory', 'inventory.product_id', '=', 'product.product_id')
            ->orderBy('inventory.id', 'desc')
            ->groupBy('product.product_id')
            ->limit(5)
            ->get();




        return response()
            ->json([
                'data' => [
                    'sales' => [
                        'total_products' => intval(number_format($totalProducts, 2, '.', ',')),
                        'total_products_yesterday' => intval($totalProductsYesterday),
                        'total_sold' => floatval($totalSold),
                        'total_sold_yesterday' => floatval(number_format($totalSoldYesterday, 2, '.', ',')),
                        'total_credit' => floatval(number_format($totalCredit, 2, '.', ',')),
                        'total_credit_yesterday' => floatval(number_format($totalCreditYesterday, 2, '.', ',')),
                        'percent_products' => floatval(number_format($percentProducts, 2, '.', ',')),
                        'percent_sold' => floatval(number_format($percentSold, 2, '.', ',')),
                        'percent_credit' => floatval(number_format($percentCredit, 2, '.', ',')),
                        'latest_products_sold' => ($latestSoldProducts->values()->toArray()),
                        'latest_sales' => ($latestSales->values()->toArray()),
                        'latest_credits' => ($latestCredits->values()->toArray()),
                        'total_products_per_day' => ($totalProducts7Days->reverse()->values()->toArray()),
                        'total_sold_per_day' => ($totalSoldDays->reverse()->values()->toArray()),
                        'total_un_paid_per_day' => ($totalUnPaidDays->reverse()->values()->toArray()),
                        'days' => ($totalProducts7Days->reverse()->keys()->toArray()),
                        'sales_per_year' => $this->movements_by_year()
                    ],
                    'purchases' => [
                        'latest_purchases' => $latestPurchases,
                        'new_products' => $newProducts
                    ]
                ]
            ]);


    }

    private function sales($start_date, $end_date)
    {

        return SalesOrderHeader::select(
            'sales_order_id',
            'paid',
            'order_date',
            \DB::raw('DATE_FORMAT(order_date,"%w") as day'),
            'payment_type',
            'subtotal',
            'freight',
            'total_due',
            'person.first_name',
            'person.last_name',
            'customer.business_name',
            'customer.nit',
            \DB::raw('(select sum(order_quantity) from  sales_order_detail where sales_order_header_id  = sales_order_id group by sales_order_header_id) as total_products')
        )->join('customer', 'customer.customer_id', '=', 'sales_order_header.customer_id')
            ->join('person', 'person.business_entity_id', '=', 'customer.business_entity_id')
            ->whereBetween('order_date',
                [
                    $start_date,
                    $end_date,
                ]
            )->orderBy('sales_order_id', 'desc')
            ->get();
    }

    private function sales_detail($ids)
    {
        return SalesOrderDetail::select(
            'id',
            'product.product_id',
            'order_quantity',
            'unit_price',
            'unit_price_discount',
            'line_total',
            'code',
            'sku',
            'name',
            \DB::raw('(Select path from product_photo where product_photo.product_id = product.product_id order by default_cover  desc  limit 1) as image')
        )->join('product', 'product.product_id', '=', 'sales_order_detail.product_id')
            ->whereIn('sales_order_header_id', $ids)
            ->get();
    }

    private function purchases($start_date, $end_date)
    {
        return PurchaseOrderHeader::select(
            'order_date as time',
            'subtotal',
            'tax_amount',
            'freight',
            'total_due',
            'ship_method.name as ship_method',
            'person.first_name as employee_first_name',
            'person.last_name as employee_last_name',
            'vendor.name as vendor',
            \DB::raw('concat("Pedido de ",vendor.name,", monto de Q",total_due," - ", ship_method.name) as title')
        )
            ->join('vendor', 'vendor.vendor_id', '=', 'purchase_order_header.vendor_id')
            ->join('employee', 'employee.employee_id', '=', 'purchase_order_header.employee_id')
            ->join('business_entity', 'business_entity.business_entity_id', '=', 'employee.business_entity_id')
            ->join('person', 'person.business_entity_id', '=', 'business_entity.business_entity_id')
            ->leftJoin('ship_method', 'ship_method.ship_method_id', '=', 'purchase_order_header.ship_method_id')
            ->orWhere(function ($query) {
                return $query->completed();
            })
            ->orWhere(function ($query) {
                return $query->received();
            })
            ->whereBetween('order_date',
                [
                    $start_date,
                    $end_date,
                ]
            )->orderBy('purchase_order_id', 'desc')
            ->get();
    }


    private function get_name_day($d)
    {

        $day = '';
        switch ($d) {
            case 0:
                $day = "Domingo";
                break;
            case 1:
                $day = "Lunes";
                break;
            case 2:
                $day = "Martes";
                break;
            case 3:
                $day = "Miercoles";
                break;
            case 4:
                $day = "Jueves";
                break;
            case 5:
                $day = "Viernes";
                break;
            case 6:
                $day = "Sabado";
                break;
            default:
                break;


        }
        return $day;

    }

    private function get_name_month($m)
    {
        $month = '';
        switch ($m) {
            case 1:
                $month = "Ene";
                break;
            case 2:
                $month = "Feb";
                break;
            case 3:
                $month = "Mar";
                break;
            case 4:
                $month = "Abr";
                break;
            case 5:
                $month = "May";
                break;
            case 6:
                $month = "Jun";
                break;
            case 7:
                $month = "Jul";
                break;
            case 8:
                $month = "Ago";
                break;
            case 9:
                $month = "Sep";
                break;
            case 10:
                $month = "Oct";
                break;
            case 11:
                $month = "Nov";
                break;
            case 12:
                $month = "Dic";
                break;
            default:
                break;


        }
        return $month;
    }

    private function movements_by_year()
    {

        $sales_by_month = SalesOrderHeader::select(
            \DB::raw('month(order_date) as month'),
            \DB::raw('sum(total_due)as total'),

        )
            ->where('paid', 1)
            ->groupBy(\DB::raw('month(order_date)'))
            ->get();


        $purchases_by_month = PurchaseOrderHeader::select(
            \DB::raw('month(order_date) as month'),
            \DB::raw('sum(total_due)as total'),

        )
            ->completed()
            ->groupBy(\DB::raw('month(order_date) '))
            ->get();

        $months = collect(range(1, Carbon::today()->month));


        return [
            'months' => $months->map(function ($item) {
                return $this->get_name_month($item);
            })->toArray(),
            'sales_per_month' => ($months->map(function ($item) use ($sales_by_month) {
                return $sales_by_month->where('month', $item);
            })->map(function ($item) {
                return $item->isEmpty() ? 0 : floatval(($item->first()->total));
            }))->toArray(),
            'purchases_per_month' => ($months->map(function ($item) use ($purchases_by_month) {
                return $purchases_by_month->where('month', $item);
            })->map(function ($item) {
                return $item->isEmpty() ? 0 : floatval(($item->first()->total));
            }))->toArray()
        ];


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
