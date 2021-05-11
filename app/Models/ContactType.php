<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    use HasFactory;


    protected $table = 'contact_type';

    protected $fillable = [
        'name'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
}
