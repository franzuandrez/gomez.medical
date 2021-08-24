<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';
    protected $table = 'employee';

    protected $fillable = [
        'national_id_number',
        'login_id',
        'job_title',
        'birth_date',
        'marital_status',
        'gender',
        'hired_date',

    ];

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function businessEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BusinessEntity::class,
            'business_entity_id',
            'business_entity_id'
        );

    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,
            'login_id',
            'id'
        );

    }
}
