<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalInventoryDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'physical_inventory_detail';

    protected $fillable = [
        'header_id',
        'product_id',
        'batch',
        'location_id',
        'location_id',
        'system_quantity',
        'physical_quantity',
        'missing_quantity',
        'price',
        'total_system',
        'total_physical',
        'total_missing',
    ];


    public function header(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(PhysicalInventoryHeader::class, 'header_id', 'id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Product::class, 'product_id', 'product_id');

    }
}
