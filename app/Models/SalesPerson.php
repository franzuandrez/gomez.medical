<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesPerson extends Model
{
    use HasFactory;

    protected $table = 'sales_person';
    protected $primaryKey = 'sales_person_id';


    protected $fillable = [
        'sales_quota',
        'bonus',
        'commission_pct',
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function businessEntity(): BelongsTo
    {

        return $this->belongsTo(BusinessEntity::class, 'business_entity_id', 'business_entity_id');
    }
}
