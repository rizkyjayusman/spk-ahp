<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\HistoriGangguanRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoriGangguanService
{
    private $historiGangguanRepository;

    public function __construct(HistoriGangguanRepository $historiGangguanRepository)
    {
        $this->historiGangguanRepository = $historiGangguanRepository;
    }

    public function getHistoriGangguanList($request)
    {
        return $this->historiGangguanRepository->getHistoriGangguanList($request);
    }

    public function save($request = [])
    {
        $request['durasi_gangguan'] = $this->calculateDurasiGangguan($request);
        return $this->historiGangguanRepository->save($request);
    }

    private function calculateDurasiGangguan($request = []) {
        $startDate = Carbon::parse($request['awal_gangguan']);
        $endDate = Carbon::parse($request['akhir_gangguan']);
        return $endDate->diffInMinutes($startDate);
    }

    public function getHistoriGangguanById($id)
    {
        return $this->historiGangguanRepository->getHistoriGangguanById($id);
    }

    public function update($id, $request = [])
    {
        $request['durasi_gangguan'] = $this->calculateDurasiGangguan($request);
        return $this->historiGangguanRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->historiGangguanRepository->delete($id);
    }

    public function getRestitusi($request = []) {
        $restitusiList = $this->historiGangguanRepository->getRestitusi($request);
        return $restitusiList;
    }

    
    public function getRestitusiByMonthAndLokasiId($month, $lokasiId) {
        $restitusiList = $this->historiGangguanRepository->getRestitusiByMonthAndLokasiId($month, $lokasiId);
        return $restitusiList;
    }

    public function getTotalHistori() {
        return $this->historiGangguanRepository->getTotalHistori();
    }

}
