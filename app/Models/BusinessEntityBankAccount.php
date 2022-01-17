<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessEntityBankAccount extends Model
{
    use HasFactory;

    protected $table = 'bank_account';

    protected $fillable = [
        'business_entity_id',
        'account_number',
        'bank_id',
        'is_default'
    ];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

}
