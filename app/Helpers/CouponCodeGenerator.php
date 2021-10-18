<?php

namespace App\Helpers;

class CouponCodeGenerator
{
    public static function generate($prefix)
    {
        $stringCode = self::generateRandomString();
        $numberCode = self::generateRandomNumber();
        $couponCode = $stringCode . $numberCode; 

        return $prefix . str_shuffle($couponCode);
    }
    
    private static function generateRandomString()
    {
        $characters = array_merge(range('A','Z'), range('a','z'));
        $max = count($characters) - 1;
        
        $randomString = null;
        $length = config('coupon.coupon_code.alphabetic.length');
        for($i = 0; $i < $length; $i++) 
        {
            $rand = mt_rand(0, $max);
            $randomString .= $characters[$rand];
        }

        return $randomString;
    }

    private static function generateRandomNumber()
    {
        $randomNumber = null;
        $length = config('coupon.coupon_code.numeric.length');
        for($i = 0; $i < $length; $i++) 
        {
            $randomNumber .= random_int(0, 9); 
        }

        return $randomNumber;
    }

}
