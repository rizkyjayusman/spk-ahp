<?php

namespace App\Services;

use App\Constants\CouponType;
use App\Exceptions\CouponSettingNotFoundException;
use App\Exceptions\ProductNotFoundException;
use App\Helpers\CouponCodeGenerator;
use App\Repositories\CouponRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponService
{
	private $couponRepository;
	    private $couponSettingService;
    private $productService;

	public function __construct(CouponRepository $couponRepository,
		        CouponSettingService $couponSettingService,
        ProductService $productService)
    {
	    $this->couponRepository = $couponRepository;
	            $this->couponSettingService = $couponSettingService;
        $this->productService = $productService;
    }

    public function createBulkCoupon($request)
    {
        $product = $this->productService->getProductById($request['product_id']);
        if(empty($product)) {
            throw new ProductNotFoundException($request['product_id']);
	}


	        $couponSetting = $this->couponSettingService->getCouponSettingByProductId($request['product_id']);
	        if(empty($couponSetting)) {
			throw new CouponSettingNotFoundException($request['product_id']);
		}

        $couponList = [];
        for($i = 0; $i < $request['size']; $i++) {
            $couponList[] = [
                // 'type' => $request['type'],
                'type' => CouponType::FULL_DISCOUNT,
                'coupon_code' => CouponCodeGenerator::generate($couponSetting->prefix),
                'product_id' => $request['product_id'],
                'expired_at' => Carbon::createFromFormat('Y-m-d', $request['expired_at'])->endOfDay()->toDateTimeString(),
                // 'amount' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $couponChunkList = array_chunk($couponList, 500);
        foreach($couponChunkList as $couponChuck) {
            $this->couponRepository->createBulkCoupon($couponChuck);
        }

        return [];
    }

    public function getCouponByCouponCode($couponCode) 
    {
        return $this->couponRepository->getCouponByCouponCode($couponCode);
    }

    public function getCouponList($request)
    {
        return $this->couponRepository->getCouponList($request);
    }
    
    public function getCouponActive()
    {
        return $this->couponRepository->getCouponActive();
    }

    public function getCouponDetail($id)
    {
        return $this->couponRepository->getCouponDetail($id);
    }


    	public function updateToExpiredCouponIfLessThanNow() {
        	return $this->couponRepository->updateToExpiredCoupon(Carbon::now());
	}   

    public function hello() {
    	return "hi";
    } 
}
