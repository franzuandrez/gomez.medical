<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePayment extends Model
{
    use HasFactory;
    protected $table = 'purchase_order_payments';


    protected $fillable = [
        'payment_date',
        'purchase_id',
        'payment_type_id',
        'employee_id',
        'amount',
        'doc_number_reference',
        'observations',
    ];
}
