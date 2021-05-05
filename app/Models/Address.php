<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    protected $table = 'address';
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'address_line_1',
        'address_line_2',
        'city',
        'postal_code',
        'latitude',
        'longitude',
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

}
