<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReason extends Model
{
    use HasFactory;

    protected $table = 'sales_reasons';

    protected $primaryKey = 'sales_reason_id';

    protected $fillable = [
        'name',
        'reason_type'
    ];


    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
}
