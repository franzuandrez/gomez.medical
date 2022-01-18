<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayInPayOut extends Model
{
    use HasFactory;


    protected $table = 'pay_in_pay_out';

    protected $fillable = [
        'doc_type',
        'doc_id',
        'amount',
        'pay_date',
        'description',
        'comments',
        'factor',
        'cash_register_id',
        'employee_id',
    ];
}
