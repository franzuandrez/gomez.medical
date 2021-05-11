<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;


    protected $table = 'position';
    protected $primaryKey = 'position_id';

    protected $fillable = [
        'name'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function level(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(RackLevel::class, 'level_id', 'level_id');

    }

    public function bins(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Bin::class, 'position_id', 'position_id');
    }

    public function inventoryMovements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InventoryMovement::class, 'position_id', 'position_id');

    }

}
