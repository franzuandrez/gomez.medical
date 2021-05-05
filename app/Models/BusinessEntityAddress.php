<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEntityAddress extends Model
{
    use HasFactory;

    protected $table = 'business_entity_address';
    protected $primaryKey = 'business_address_id';

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function addressType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(AddressType::class, 'address_type_id', 'address_type_id');
    }

    public function businessEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BusinessEntity::class, 'business_entity_id', 'business_entity_id');
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }
}
