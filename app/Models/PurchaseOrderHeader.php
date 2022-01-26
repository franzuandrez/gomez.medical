<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderHeader extends Model
{
    use HasFactory;

    protected $table = 'purchase_order_header';
    protected $primaryKey = 'purchase_order_id';
    const STATUS_PENDING = 1;
    const STATUS_RECEIVED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_COMPLETED = 4;

    protected $fillable = [
        'status',
        'order_date',
        'subtotal',
        'tax_amount',
        'total_due',
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function markAsPending()
    {
        $this->status = self::STATUS_PENDING;
        $this->save();
    }

    public function markAsReceived()
    {
        $this->status = self::STATUS_RECEIVED;
        $this->save();
    }

    public function markAsRejected()
    {
        $this->status = self::STATUS_REJECTED;
        $this->save();
    }

    public function markAsCompleted()
    {
        $this->status = self::STATUS_COMPLETED;
        $this->save();
    }

    public function scopeCompleted($query)

    {
        return $query->where('purchase_order_header.status', self::STATUS_COMPLETED);
    }

    public function scopeReceived($query)
    {

        return $query->where('purchase_order_header.status', self::STATUS_RECEIVED);
    }

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }


    public function vendor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function shipMethod(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ShipMethod::class, 'ship_method_id', 'ship_method_id');

    }

    public function purchaseOrderDetail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(PurchaseOrderDetail::class, 'purchase_order_id', 'purchase_order_id')
            ->select('*')//TODO optimize this query
            ->join('product_vendor', 'product_vendor.product_id', '=', 'purchase_order_details.product_id');
    }
}
