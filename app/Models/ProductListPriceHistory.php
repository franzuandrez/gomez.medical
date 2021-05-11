<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductListPriceHistory extends Model
{
    use HasFactory;


    protected $table = 'product_list_price_history';
    protected $primaryKey = 'product_list_price_id';

    protected $fillable = [
        'list_price'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
}
