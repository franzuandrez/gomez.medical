<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;


    protected $primaryKey = 'warehouse_id';


    protected $table = 'warehouse';

    protected $fillable = [
        'name'
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function sections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(SectionLocation::class, 'warehouse_id', 'warehouse_id');
    }
}
