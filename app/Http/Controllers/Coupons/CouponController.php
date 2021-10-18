<?php

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Traits\ResponseBuilder;

class CouponController extends Controller
{
    use ResponseBuilder;

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $productList = $this->productService->getProductList();
        return view('pages.coupon.index', [
            "productList" => $productList,
        ]);
    }
}
