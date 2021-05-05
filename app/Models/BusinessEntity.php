<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEntity extends Model
{
    use HasFactory;


    protected $primaryKey = 'business_entity_id';
    protected $table = 'business_entity';


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function businessEntityAddress(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(BusinessEntityAddress::class, 'business_entity_id', 'business_entity_id');
    }
}
