<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderHeader extends Model
{
    use HasFactory;

    protected $table = 'sales_order_header';
    protected $primaryKey = 'sales_order_id';
    const STATUS_IN_PROCESS = 1;
    const STATUS_APPROVED = 2;
    const STATUS_BACKORDER = 3;
    const STATUS_REJECTED = 4;
    const STATUS_SHIPPED = 5;
    const STATUS_CANCELLED = 6;
    const STATUS_PAID = 1;

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


    public function markAsInProcess()
    {

        $this->status = self::STATUS_IN_PROCESS;
        $this->save();
    }

    public function maskAsApproved()
    {

        $this->status = self::STATUS_APPROVED;
        $this->save();
    }

    public function markAsBackOrdered()
    {
        $this->status = self::STATUS_BACKORDER;
        $this->save();
    }

    public function markAsRejected()
    {

        $this->status = self::STATUS_REJECTED;
        $this->save();
    }

    public function markAsShipped()
    {

        $this->status = self::STATUS_SHIPPED;
        $this->save();
    }

    public function markAsCancelled()
    {
        $this->status = self::STATUS_CANCELLED;
        $this->save();
    }

    public function markAsPaid()
    {
        $this->paid = self::STATUS_PAID;
        $this->save();
    }

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
