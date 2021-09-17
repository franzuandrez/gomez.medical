<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhysicalInventoryHeader extends Model
{
    use HasFactory;


    protected $table = 'physical_inventory_header';
    protected $primaryKey = 'id';


    protected $fillable = [
        'start_date',
        'end_date',
        'done_by',
        'status',
        'comments',
    ];

    public function detail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(PhysicalInventoryDetail::class, 'header_id', 'id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,
            'done_by',
            'employee_id');
    }

}
