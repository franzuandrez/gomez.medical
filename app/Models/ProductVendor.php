<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVendor extends Model
{
    use HasFactory;


    protected $table = 'product_vendor';
    protected $primaryKey = 'product_vendor_id';

    protected $fillable = [
        'average_lead_time',
        'standard_price',
        'last_recipient_cost',
        'last_recipient_date',
        'min_order_quantity',
    ];


    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

}
