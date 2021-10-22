<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\HistoriGangguanService;
use App\Services\LokasiService;
use App\Traits\ResponseBuilder;

class RestitusiController extends Controller
{
    use ResponseBuilder;

    private $historiGangguanService;
    private $lokasiService;

    public function __construct(HistoriGangguanService $historiGangguanService,
        LokasiService $lokasiService)
    {
        $this->historiGangguanService = $historiGangguanService;
        $this->lokasiService = $lokasiService;
    }

    public function index()
    {
        return view('pages.restitusi.index');
    }

    public function detail($month, $lokasiId) {
        $restitusiDetail = $this->historiGangguanService->getRestitusiByMonthAndLokasiId($month, $lokasiId);
        $historiGangguanList = $this->historiGangguanService->getHistoriGangguanList([
            'month' => $month,
            'lokasi_id' => $lokasiId,
        ]);
        $lokasi = $this->lokasiService->getLokasiById($lokasiId);
        return view('pages.restitusi.detail', [
            'restitusi' => $restitusiDetail,
            'histori_gangguan' => $historiGangguanList,
            'lokasi' => $lokasi,
        ]);
    }
}
