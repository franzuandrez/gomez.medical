<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corridor extends Model
{
    use HasFactory;


    protected $table = 'corridor';

    protected $primaryKey = 'corridor_id';

    protected $fillable = [
        'name'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(SectionLocation::class, 'section_id', 'section_id');

    }

    public function racks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rack::class, 'corridor_id', 'corridor_id');
    }


}
