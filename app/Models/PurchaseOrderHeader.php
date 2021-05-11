<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderHeader extends Model
{
    use HasFactory;

    protected $table = 'purchase_order_header';
    protected $primaryKey = 'purchase_order_id';


    protected $fillable = [
        'status',
        'order_date',
        'subtotal',
        'tax_amount',
        'total_due',
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


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

        return $this->hasMany(PurchaseOrderDetail::class, 'purchase_order_id', 'purchase_order_id');
    }
}
