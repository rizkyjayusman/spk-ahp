<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CouponService;
use Exception;

class ExpiredCoupon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ubah semua coupon yang sudah lewat dari batas waktu menjadi expired';

	private $couponService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CouponService $couponService)
    {
	    parent::__construct();
	    $this->couponService = $couponService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
	    try {
	    	$this->couponService->updateToExpiredCouponIfLessThanNow();
		// $this->error("success to updated coupon to expired");
	    } catch (Exception $e) {
	    	$this->error("failed to update coupon to expired cause " . $e);	
	    }
	// $this->error('set coupon to expired');
	    
	return 1;
    }
}
