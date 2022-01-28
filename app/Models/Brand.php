<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;


    protected $table = 'product_brand';
    protected $primaryKey = 'brand_id';

    protected $fillable = [
        'name',
    ];


}
