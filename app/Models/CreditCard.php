<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;


    protected $table = 'credit_card';

    protected $primaryKey = 'credit_card_id';

    protected $fillable = [
        'card_type',
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

}
