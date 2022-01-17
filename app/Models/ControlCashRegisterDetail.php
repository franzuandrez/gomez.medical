<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ControlCashRegisterDetail extends Model
{
    use HasFactory;

    protected $table = 'cash_register_control_detail';


    protected $fillable = [
        'header_id',
        'start_value',
        'total_system',
        'in_drawer',
        'counted',
        'difference',
        'cash_out',
        'new_start_value'
    ];

    public $timestamps = false;


    public function header(): BelongsTo
    {
        return $this->belongsTo(ControlCashRegisterHeader::class, 'header_id', 'id');
    }
}
