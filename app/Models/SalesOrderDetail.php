<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model
{
    use HasFactory;


    protected $table = 'sales_order_detail';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_quantity',
        'unit_price',
        'unit_price_discount',
        'line_total'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function salesOrderHeader(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(SalesOrderHeader::class,
            'sales_order_header_id',
            'sales_order_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function specialOffer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SpecialOffer::class, 'special_offer_id', 'special_offer_id');
    }
}
