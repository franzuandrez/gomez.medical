<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;


    protected $primaryKey = 'product_id';
    protected $table = 'product';

    protected $fillable = [
        'name',
        'color',
        'safety_stock_level',
        'size',
        'weight',
        'product_subcategory_id',
        'instructions'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function subcategory(): BelongsTo
    {
        return $this
            ->belongsTo(ProductSubcategory::class,
                'product_subcategory_id',
                'product_subcategory_id');
    }

    public function costHistory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductCostHistory::class,
            'product_id',
            'product_id');
    }

    public function listPriceHistory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductListPriceHistory::class,
            'product_id',
            'product_id');
    }

    public function photos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(ProductPhoto::class,
            'product_id',
            'product_id');

    }

    public function currentPrice(): \Illuminate\Database\Eloquent\Relations\HasOne
    {

        return $this->hasOne(ProductListPriceHistory::class,
            'product_id',
            'product_id')
            ->where(function ($query) {
                $query->orWhereDate('end_date', '>=', Carbon::now())
                    ->orWhereNull('end_date');
            })
            ->orderBy('product_list_price_id', 'desc')
            ->limit(1);
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }


}
