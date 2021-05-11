<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAddress extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'email_addresses';
    protected $fillable = [
        'email_address'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


}
