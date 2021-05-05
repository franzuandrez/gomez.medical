<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
    use HasFactory;

    protected $table = 'address_type';

    protected $primaryKey = 'address_type_id';
    protected $fillable = [
        'name'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
}
