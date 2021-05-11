<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonCreditCard extends Model
{
    use HasFactory;


    protected $table = 'person_credit_card';
    protected $primaryKey = 'id';


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function businessEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(BusinessEntity::class, 'business_entity_id', 'business_entity_id');
    }

    public function creditCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CreditCard::class, 'credit_card_id', 'credit_card_id');
    }
}
