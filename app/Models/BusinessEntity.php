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

    public function emailAddress(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailAddress::class, 'business_entity_id', 'business_entity_id');
    }

    public function person(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Person::class, 'business_entity_id', 'business_entity_id');
    }


    public function creditCards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {


        return $this->hasMany(PersonCreditCard::class, 'business_entity_id', 'business_entity_id');

    }

    public function vendor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Vendor::class, 'business_entity_id', 'business_entity_id');

    }

    public function salesPerson(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SalesPerson::class, 'business_entity_id', 'business_entity_id');

    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Customer::class, 'business_entity_id', 'business_entity_id');

    }
}
