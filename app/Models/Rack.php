<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;


    protected $table = 'rack';
    protected $primaryKey = 'rack_id';

    protected $fillable = [
        'name'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function corridor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Corridor::class, 'corridor_id', 'corridor_id');
    }

    public function levels(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RackLevel::class, 'rack_id', 'rack_id');
    }

}
