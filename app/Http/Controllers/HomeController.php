<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CouponService;
use App\Services\HistoriGangguanService;
use App\Services\KategoriGangguanService;
use App\Services\LokasiService;
use App\Services\UserService;

class HomeController extends Controller
{

    private $historiGangguanService;
    private $kategoriGangguanService;
    private $lokasiService;
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(HistoriGangguanService $historiGangguanService,
        KategoriGangguanService $kategoriGangguanService,
        LokasiService $lokasiService,
        UserService $userService)
    {
        $this->middleware('auth');
        $this->historiGangguanService = $historiGangguanService;
        $this->kategoriGangguanService = $kategoriGangguanService;
        $this->lokasiService = $lokasiService;
        $this->userService = $userService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard', [
            'total_histori_gangguan' => $this->historiGangguanService->getTotalHistori(),
            'total_kategori_gangguan' => $this->kategoriGangguanService->getTotalKategori(),
            'total_lokasi' => $this->lokasiService->getTotalLokasi(),
            'total_user' => $this->userService->getTotalUser(),
        ]);
    }
}
