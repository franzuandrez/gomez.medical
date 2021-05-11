<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPerson extends Model
{
    use HasFactory;

    protected $table = 'sales_person';
    protected $primaryKey = 'sales_person_id';


    protected $fillable = [
        'sales_quota',
        'bonus',
        'commission_pct',
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
}
