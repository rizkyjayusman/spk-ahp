<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = [
        'name',
        'price',
        'product_type',
        'status',
        'image_url',
        'description',
    ];
}
