<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'nit'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function businessEntity(): BelongsTo
    {


        return $this
            ->belongsTo(BusinessEntity::class,
                'business_entity_id',
                'business_entity_id');


    }


    public function salesOrderHeader(): HasMany
    {
        return $this->hasMany(SalesOrderHeader::class, 'customer_id', 'customer_id');
    }
}
