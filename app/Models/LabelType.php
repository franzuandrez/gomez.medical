<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelType extends Model
{
    use HasFactory;


    protected $table =  'label_type';

    protected $fillable = [
        'name',
        'label_width',
        'label_height',
        'x_value',
        'y_value',
        'type',
        'code_height',
        'readable',
        'rotation',
        'narrow',
        'wide',
        'unit',
        'x_product_name',
        'y_product_name',
        'height_product_name',
    ] ;
}
