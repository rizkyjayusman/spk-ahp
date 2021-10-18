<?php

namespace App\Http\Controllers\v1\Api\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkCouponCreationRequest;
use App\Services\CouponService;
use App\Traits\ResponseBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    use ResponseBuilder;

    private $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function createBulkCoupon(BulkCouponCreationRequest $request)
    {
        $couponList = $this->couponService->createBulkCoupon($request->validated());

        return $this->success(__('coupon.bulk_creation.success'), $couponList);
    }

    public function index(Request $request)
    {
        $couponList = $this->getCouponList($request->all());
        return DataTables::of($couponList)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('pages.coupon.components.action', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getCouponList($request)
    {
        $couponList = $this->couponService->getCouponList($request);
        return $couponList;
    }

    public function detail($id)
    {
        $coupon = $this->couponService->getCouponDetail($id);
        return $coupon;
    }

    public function export(Request $request) 
    {
        $fileName = 'coupon-list-'. now()->format('YmdHis') .'.csv';
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = [
            'Coupon Code', 
            'Product Name',
            'Status',
            'Created Date',
            'Expired Date',
        ];

        $couponList = $this->getCouponList($request->all());
        $callback = function() use($couponList, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($couponList as $coupon) {
                $row['coupon_code'] = $coupon->coupon_code;
                $row['product_name'] = $coupon->product->name;
                $row['status'] = $coupon->status_label;
                $row['created_date'] = $coupon->created_at;
                $row['expired_date'] = $coupon->expired_at;

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
