<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumberType extends Model
{
    use HasFactory;

    protected $primaryKey = 'phone_number_type_id';
    protected $table = 'phone_number_type';


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function phoneNumbers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {


        return $this->hasMany(PersonPhone::class, 'phone_number_type_id', 'phone_number_type_id');
    }

}
