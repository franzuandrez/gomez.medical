<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCostHistory extends Model
{
    use HasFactory;


    protected $table = 'product_cost_history';

    protected $primaryKey = 'product_cost_id';

    protected $fillable = [
        'start_date',
        'end_date',
        'standard_cost'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
