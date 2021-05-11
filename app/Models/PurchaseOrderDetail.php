<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'purchase_order_details';
    protected $primaryKey = 'id';


    protected $dates = [
        'due_date'
    ];
    protected $fillable = [
        'due_date',
        'order_quantity',
        'unit_price',
        'line_total',
        'received_quantity',
        'rejected_quantity',
        'stocked_quantity'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function purchaseOrderHeader(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(PurchaseOrderHeader::class, 'purchase_order_id',
            'purchase_order_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');

    }



}
