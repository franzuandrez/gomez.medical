<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionLocation extends Model
{
    use HasFactory;

    protected $primaryKey = 'section_id';
    protected $table = 'section';
    protected $fillable = [
        'name'
    ];
    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
    public function warehouse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }


    public function corridors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Corridor::class, 'section_id', 'section_id');
    }


}
