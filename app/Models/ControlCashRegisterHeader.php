<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ControlCashRegisterHeader extends Model
{
    use HasFactory;

    protected $table = 'cash_register_control_header';

    protected $fillable = [
        'started_at',
        'ended_at',
        'seller_id',
        'shift_id',
        'supervised_id',
        'cash_register_id',
        'status'
    ];


    public $timestamps = false;


    public function detail(): HasMany
    {

        return $this->hasMany(ControlCashRegisterDetail::class, 'header_id', 'id');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class, 'id', 'shift_id');
    }

    public function cash_register(): BelongsTo
    {
        return $this->belongsTo(CashRegister::class,'id','cash_register_id');
    }
}
