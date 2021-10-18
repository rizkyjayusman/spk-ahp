<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponUsageHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'invoice_id',
        'user_id',
        'coupon_id',
        'redeem_at',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
