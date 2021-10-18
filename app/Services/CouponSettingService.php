<?php

namespace App\Services;

use App\Repositories\CouponSettingRepository;

class CouponSettingService
{
    private $couponSettingRepository;

    public function __construct(CouponSettingRepository $couponSettingRepository)
    {
        $this->couponSettingRepository = $couponSettingRepository;
    }

        public function getCouponSettingByProductId($productId) {
		        return $this->couponSettingRepository->getCouponSettingByProductId($productId);
			    }

    }

