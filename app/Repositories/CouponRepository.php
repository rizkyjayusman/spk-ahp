<?php

namespace App\Repositories;

use App\Constants\CouponStatus;
use App\Coupon;
use App\CouponUsageHistory;

class CouponRepository
{
    public function __construct()
    {
    }

    public function createBulkCoupon(array $request)
    {
        return Coupon::insert($request);
    }

    public function getCouponByCouponCode($couponCode)
    {
        return Coupon::where('coupon_code', $couponCode)->first();
    }

    public function getCouponList($request)
    {
        $coupon = Coupon::latest();

        if (! empty($request['from_date']) && ! empty($request['to_date'])) {
            $coupon->whereBetween('created_at', [$request['from_date'].' 00:00:00', $request['to_date'].' 23:59:59']);
	}

	        if(! empty($request['coupon_code'])) {
			            $coupon->where('coupon_code', 'like', '%' . $request['coupon_code'] . "%");
				            }

	        if(! empty($request['product_id'])) {
			            $coupon->where('product_id', $request['product_id']);
				            }
		
	       if(! is_null($request['status'])) {
		            $coupon->where('status', $request['status']);
				            }


        return $coupon->get();
    }

    public function getCouponActive()
    {
        return Coupon::whereStatus(1)->get();
    }

    public function getCouponDetail($id)
    {
        $couponUsage = CouponUsageHistory::whereCouponId($id)->with('user','coupon')->first();
        return $couponUsage;
    }

    
    public function updateToExpiredCoupon($date) {
	    Coupon::where('expired_at', '<', $date)
		    ->where('status', CouponStatus::ACTIVE)->update([ 'status' => CouponStatus::EXPIRED ]);
    }

}
