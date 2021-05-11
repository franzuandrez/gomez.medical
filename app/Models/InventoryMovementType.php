<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovementType extends Model
{
    use HasFactory;


    protected $table = 'movement_type';
    protected $primaryKey = 'movement_type_id';

    protected $fillable = [
        'name',
        'factor'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

}
