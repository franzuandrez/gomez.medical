<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonPhone extends Model
{
    use HasFactory;

    protected $table = 'person_phone';
    protected $primaryKey = 'person_phone_id';


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function phoneNumberType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(PhoneNumberType::class, 'phone_number_type_id', 'phone_number_type_id');
    }

    public function businessEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BusinessEntity::class, 'business_entity_id', 'business_entity_id');
    }

}
