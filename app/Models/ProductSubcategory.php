<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    use HasFactory;

    protected $table = 'product_subcategory';

    protected $primaryKey = 'product_subcategory_id';
    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function productCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'product_category_id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this
            ->hasMany(Product::class,
                'product_subcategory_id',
                'product_subcategory_id');
    }


}
