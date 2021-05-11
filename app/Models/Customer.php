<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'number_account'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function businessEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {


        return $this
            ->belongsTo(BusinessEntity::class,
                'business_entity_id',
                'business_entity_id');


    }


    public function salesOrderHeader(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SalesOrderHeader::class, 'customer_id', 'customer_id');
    }
}
