<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    use HasFactory;

    protected $table = 'inventory';
    protected $primaryKey = 'id';


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }


    public function warehouse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }


    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SectionLocation::class, 'section_id', 'section_id');
    }

    public function corridor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Corridor::class, 'corridor_id', 'corridor_id');
    }


    public function rack(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rack::class, 'rack_id', 'rack_id');
    }

    public function rackLevel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RackLevel::class, 'level_id', 'level_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }

    public function bin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bin::class, 'bin_id', 'bin_id');
    }

    public function movementType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InventoryMovementType::class, 'movement_type_id', 'movement_type_id');
    }

}
