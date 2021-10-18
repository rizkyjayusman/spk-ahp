<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\HistoriGangguanService;
use App\Traits\ResponseBuilder;

class RestitusiController extends Controller
{
    use ResponseBuilder;

    private $historiGangguanService;

    public function __construct(HistoriGangguanService $historiGangguanService)
    {
        $this->historiGangguanService = $historiGangguanService;
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
        return view('pages.restitusi.detail', [
            'restitusi' => $restitusiDetail,
            'histori_gangguan' => $historiGangguanList,
        ]);
    }
}
