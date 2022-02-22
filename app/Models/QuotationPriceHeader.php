<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationPriceHeader extends Model
{
    use HasFactory;


    protected $table = 'quotation_price_header';
    public $timestamps = false;

    public $fillable = [
        'quotation_date',
        'sales_person_id',
        'subtotal',
        'total',
        'tax_amount',
        'bill_to_address_id',
        'comments',
        'end_date',
        'finished_as_date',
    ];
}
