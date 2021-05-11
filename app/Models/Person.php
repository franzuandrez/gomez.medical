<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;


    protected $table = 'person';
    protected $primaryKey = 'person_id';

    protected $fillable = [
        'person_type',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function businesEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(BusinessEntity::class, 'business_entity_id', 'business_entity_id');
    }
}
