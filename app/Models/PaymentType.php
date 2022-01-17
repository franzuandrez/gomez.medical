<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;


    protected $table = 'payment_type';
    protected $fillable = [
        'internal_code',
        'name'
    ];

    public $timestamps = false;
}
