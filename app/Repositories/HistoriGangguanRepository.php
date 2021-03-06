<?php

namespace App\Repositories;

use App\HistoriGangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoriGangguanRepository
{
    public function __construct()
    {
    }

    public function getHistoriGangguanList($request = [])
    {
        $historiGangguanList = HistoriGangguan::orderBy('awal_gangguan', 'desc');
        if(isset($request['status'])) {
            $historiGangguanList->where('status', $request['status']);
        }

        if(isset($request['month'])) {
            $historiGangguanList->whereRaw('month(awal_gangguan) = ?', [ $request['month'] ]);
        }

        if(isset($request['lokasi_id'])) {
            $historiGangguanList->whereRaw('lokasi_id = ?', [ $request['lokasi_id'] ]);
        }

        if(isset($request['from_date']) && isset($request['to_date'])) {
            $historiGangguanList->whereBetween('awal_gangguan', [ $request['from_date'] . ' 00:00:00', $request['to_date'] . ' 23:59:59' ]);
        }
        
        return $historiGangguanList->get();
    }

    public function save($request = [])
    {
        $historiGangguan = new HistoriGangguan;
        $historiGangguan->lokasi_id = $request['lokasi_id'];
        $historiGangguan->kategori_gangguan_id = $request['kategori_gangguan_id'];
        $historiGangguan->konklusi_id = $request['konklusi_id'];
        $historiGangguan->awal_gangguan = $request['awal_gangguan'];
        $historiGangguan->akhir_gangguan = $request['akhir_gangguan'];
        $historiGangguan->durasi_gangguan = $request['durasi_gangguan'];
        $historiGangguan->hasil_klasifikasi_id = $request['hasil_klasifikasi_id'];
        return $historiGangguan->save();
    }

    public function getHistoriGangguanById($id)
    {
        return HistoriGangguan::findOrFail($id);
    }

    public function update($id, $request = [])
    {
        $historiGangguan = HistoriGangguan::find($id);
        $historiGangguan->lokasi_id = $request['lokasi_id'];
        $historiGangguan->kategori_gangguan_id = $request['kategori_gangguan_id'];
        $historiGangguan->konklusi_id = $request['konklusi_id'];
        $historiGangguan->awal_gangguan = $request['awal_gangguan'];
        $historiGangguan->akhir_gangguan = $request['akhir_gangguan'];
        $historiGangguan->durasi_gangguan = $request['durasi_gangguan'];
        $historiGangguan->hasil_klasifikasi_id = $request['hasil_klasifikasi_id'];
        return $historiGangguan->update();
    }

    public function delete($id)
    {
        return HistoriGangguan::find($id)->delete();
    }

    public function getRestitusi($request = []) {
        // 44640 adalah menit dalam satu bulan
        // 99% atau 0.999 adalah minimum pencapaian
        // 5000000 harga satuan
        $restitusi = DB::table('histori_gangguan')
            ->join('lokasi', 'histori_gangguan.lokasi_id', '=', 'lokasi.id')
            ->select(
                DB::raw('month(awal_gangguan) as month'),
                'lokasi.id as lokasi_id', 
                'lokasi.alamat as alamat', 
                DB::raw($this->getColumnTotalDurasi()),
                DB::raw($this->getColumnCapaiKerja()),
                DB::raw($this->getColumnRestitusiPersentase()),
                DB::raw($this->getColumnNilaiRestitusiRupiah()),
                DB::raw($this->getColumnJumlahAkhir()))
            ->where('histori_gangguan.hasil_klasifikasi_id', 1);
        
        if(isset($request['month'])) {
            $restitusi->whereRaw('month(awal_gangguan) = ?', [$request['month']]);
        }

        if(isset($request['lokasi_id'])) {
            $restitusi->whereRaw('lokasi_id = ?', [$request['lokasi_id']]);
        }

        $restitusi->groupBy(DB::raw('year(awal_gangguan)'), DB::raw('month(awal_gangguan)'), 'lokasi_id');
        return $restitusi;
    }

    private function getColumnTotalDurasi() {
        return 'sum(histori_gangguan.durasi_gangguan) as total_durasi';
    }

    private function getColumnCapaiKerja() {
        return 'round(' . $this->getGangguanPerBulanInPercent() .', 4) as capai_kerja';
    }

    private function getGangguanPerBulanInPercent() {
        $gangguanPerBulan = '(44640 - sum(durasi_gangguan))'; // menit
        $gangguanPerBulanInDecimal = '(' . $gangguanPerBulan . ' / 44640)';
        return '((' . $gangguanPerBulanInDecimal . ' * 100) / 100)';
    }

    private function getColumnRestitusiPersentase() {
        return 'round('. $this->getNilaiRestitusiPercent() . ', 4) as restitusi_persentase';
    }

    private function getNilaiRestitusiPercent() {
        return '(0.999 - ' . $this->getGangguanPerBulanInPercent() . ')';
    }

    private function getColumnNilaiRestitusiRupiah() {
        return $this->getNilaiRestitusiRupiah() . ' as restitusi';
    }

    private function getNilaiRestitusiRupiah() {
        $nilaiRestitusiRupiah = '5000000 * round(' . $this->getNilaiRestitusiPercent() . ', 4)';
        $nilaiRestitusiRupiah = '(round('.$nilaiRestitusiRupiah.' / 100, 0) * 100)';
        return $nilaiRestitusiRupiah;
    }

    private function getColumnJumlahAkhir() {
        return '5000000 - ' . $this->getNilaiRestitusiRupiah() . ' as jumlah_akhir';
    }

    public function getRestitusiByMonthAndLokasiId($month, $lokasiId) {
        return $this->getRestitusi(['month' => $month, 'lokasi_id' => $lokasiId,])->first();
    }

    public function getTotalHistori() {
        return HistoriGangguan::all()->count();
    }

}
