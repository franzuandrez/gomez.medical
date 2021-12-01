<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printout extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'printouts';


    protected $fillable = [
        'quantity',
        'product_id',
        'doc_id',
        'comments',
        'printed_by',
        'is_printed',
    ];

    public function scopePurchases($query)
    {
        return $query->where('comments','PURCHASE');
    }
}
