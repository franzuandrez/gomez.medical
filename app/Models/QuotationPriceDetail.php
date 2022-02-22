<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationPriceDetail extends Model
{
    use HasFactory;

    protected $table = 'quotation_price_detail';
    public $timestamps = false;

    protected $fillable = [
        'header_id',
        'order_quantity',
        'product_id',
        'special_offer_id',
        'unit_price',
        'unit_price_discount',
        'line_total'
    ];



}
