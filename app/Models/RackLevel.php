<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackLevel extends Model
{
    use HasFactory;

    protected $table = 'level';
    protected $primaryKey = 'level_id';

    protected $fillable = [
        'name'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function rack(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Rack::class, 'rack_id', 'rack_id');
    }

    public function positions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(Position::class, 'level_id', 'level_id');
    }
}
