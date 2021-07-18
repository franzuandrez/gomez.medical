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
    public const ACTIVE = 1;


    public function save(array $options = []): bool
    {
        if (!$this->businessEntity()->exists()) {
            $business_entity = new BusinessEntity();
            $business_entity->save();
            $this->business_entity_id = $business_entity->business_entity_id;

        }
        $this->credit_rating = 0;
        $this->preferred_vendor_status = 1;
        $this->active_flag = Self::ACTIVE;

        return parent::save($options); 
    }

    public function delete(): ?bool
    {

        $this->active_flag = 0;
        return $this->update();

    }

    public function businessEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(BusinessEntity::class, 'business_entity_id', 'business_entity_id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductVendor::class, 'vendor_id', 'vendor_id');
    }
}
