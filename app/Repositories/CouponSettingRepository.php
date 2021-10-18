<?php

namespace App\Repositories;

use App\CouponSetting;

class CouponSettingRepository
{
    public function __construct()
    {
    }

    public function getCouponSettingByProductId($productId)
    {
        return CouponSetting::where('product_id', $productId)->first();
    }

    }

