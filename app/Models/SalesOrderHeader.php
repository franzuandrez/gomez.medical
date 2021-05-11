<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderHeader extends Model
{
    use HasFactory;

    protected $table = 'sales_order_header';
    protected $primaryKey = 'sales_order_id';

    protected $dates = [
        'order_date'
    ];
    protected $fillable = [
        'order_date',
        'status',
        'customer_id',
        'online_order_flag',
        'sales_order_number',
        'payment_type',
        'subtotal',
        'tax_amount',
        'freight',
        'total_due',
        'comments'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Customer::class,
            'customer_id'
            , 'customer_id');

    }

    public function salesPerson(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SalesPerson::class,
            'sales_person_id',
            'sales_person_id');
    }

    public function billAddress(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Address::class, 'bill_to_address_id', 'address_id');
    }

    public function shipAddress(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Address::class, 'ship_to_address_id', 'address_id');
    }

    public function shipMethod(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(ShipMethod::class, 'ship_method_id', 'ship_method_id');

    }


    public function salesReasons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(SalesReasonHeaderSalesReason::class,
            'sales_order_id',
            'sales_order_id');

    }

    public function salesOrderDetail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SalesOrderDetail::class,
            'sales_order_header_id',
            'sales_order_id');
    }
}
