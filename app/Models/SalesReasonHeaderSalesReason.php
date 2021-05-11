<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReasonHeaderSalesReason extends Model
{
    use HasFactory;


    protected $primaryKey = 'id';

    protected $table = 'sales_reason_header_sales_reasons';


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function salesOrder(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(SalesOrderHeader::class, 'sales_order_id', 'sales_order_id');
    }

    public function salesReason(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SalesReason::class, 'sales_reason_id', 'sales_reason_id');
    }

}
