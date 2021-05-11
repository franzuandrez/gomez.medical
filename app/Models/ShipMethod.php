<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipMethod extends Model
{
    use HasFactory;


    protected $table = 'ship_method';
    protected $primaryKey = 'ship_method_id';


    protected $fillable = [
        'name'
    ];
    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


}
