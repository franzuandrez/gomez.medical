<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;


    protected $table = 'vendor';
    protected $primaryKey = 'vendor_id';

    protected $fillable = [
        'account_number',
        'name',
        'credit_rating',
        'preferred_vendor_status',
        'active_flag',
        'url_web',

    ];
    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';


    public function businessEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(BusinessEntity::class, 'business_entity_id', 'business_entity_id');
    }
}
