<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    use HasFactory;

    protected $table = 'special_offer';
    protected $primaryKey = 'special_offer_id';


    protected $fillable = [
        'description',
        'discount_pct',
        'type',
        'category',
        'start_date',
        'end_date',
        'min_qty',
        'max_qty'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

}
