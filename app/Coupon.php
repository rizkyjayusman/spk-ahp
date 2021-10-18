<?php

namespace App;

use App\Constants\CouponStatus;
use App\Constants\CouponType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $with = ['product'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
    ];
    

    protected $fillable = [
        'type', 
        'coupon_code', 
        'amount',
        'product_id', 
        'status',
        'expired_at', 
    ];
	

    protected $appends = [ 'status_label' ];

    public function getStatusLabelAttribute() {
    	if($this->status == CouponStatus::ACTIVE) {
		return "Active";
	} else if ($this->status == CouponStatus::EXPIRED) {
		return "Expired";
	} else if ($this-> status == CouponStatus::USED) {
		return "Used";
	} 
    }

    public function setExpiredAtAttribute($val)
    {
        $expiredDate =  Carbon::createFromFormat('Y-m-d', $val)
            ->endOfDay()
            ->toDateTimeString();

        $this->attributes['expired_at'] = $expiredDate;
    }

    public function isFullDiscount()
    {
        return $this->type == CouponType::FULL_DISCOUNT;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
