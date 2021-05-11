<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory;

    protected $primaryKey = 'bin_id';
    protected $table = 'bin';

    protected $fillable = [
        'name'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';



    public function position(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }

    public function inventoryMovements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InventoryMovement::class, 'bin_id', 'bin_id');
    }
}
