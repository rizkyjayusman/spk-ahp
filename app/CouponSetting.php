<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponSetting extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
    ];
    
    protected $fillable = [
        'product_id', 
        'prefix', 
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

