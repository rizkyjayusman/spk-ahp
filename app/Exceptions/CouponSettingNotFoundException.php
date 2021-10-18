<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;
use Illuminate\Http\Response;

class CouponSettingNotFoundException extends BaseException
{
    public function __construct($id)
    {
        $errorCode = null;
        $httpStatus = Response::HTTP_BAD_REQUEST;
        parent::__construct($httpStatus, $errorCode, __('coupon.errors.setting_not_found'));
    }
}

