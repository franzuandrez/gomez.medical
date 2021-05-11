<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;


    protected $table = 'product_photo';
    protected $primaryKey = 'product_photo_id';

    protected $fillable = [
        'file_name',
        'path'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this
            ->belongsTo(Product::class,
                'product_id',
                'product_id'
            );
    }
}
