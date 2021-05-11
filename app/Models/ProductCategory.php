<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';
    protected $primaryKey = 'product_category_id';

    protected $fillable = [
        'name'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function subcategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductSubcategory::class, 'product_category_id', 'product_category_id');
    }

}
