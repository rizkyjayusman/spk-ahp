<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MonthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\HistoriGangguanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class HistoriGangguanController extends Controller
{
    private $historiGangguanService;

    public function __construct(
        HistoriGangguanService $historiGangguanService
    ) {
        $this->historiGangguanService = $historiGangguanService;
    }

    public function index(Request $request)
    {
        $historiGangguanList = $this->historiGangguanService->getHistoriGangguanList($request->all());

        return DataTables::of($historiGangguanList)
        ->addIndexColumn()
        ->addColumn('action_button', function ($row) {
            if(Auth::user()->role_id == 1) {
                return view('pages.histori_gangguan.components.action', ['row' => $row]);
            } else {
                return null;
            }
        })
        ->rawColumns(['action_button'])
        ->make(true);
    }

    public function delete($historiGangguanId)
    {
        $historiGangguan = $this->historiGangguanService->delete($historiGangguanId);

        return Response()->json([
            'success' => true,
            'data' => []
        ]);
    }

    public function exportHistori(Request $request) 
    {
        $fileName = 'histori-gangguan-'. now()->format('YmdHis') .'.csv';
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = [
            'Lokasi', 
            'Awal Gangguan',
            'Berakhirnya Gangguan',
            'Durasi Gangguan',
            'Kategori Gangguan',
            'Hasil Klasifikasi',
            'Action',
        ];

        $historiList = $this->historiGangguanService->getHistoriGangguanList($request->all());
        $callback = function() use($historiList, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns, ';');

            foreach ($historiList as $histori) {
                $row['lokasi'] = $histori->lokasi->alamat;
                $row['awal_gangguan'] = $histori->awal_gangguan;
                $row['akhir_gangguan'] = $histori->akhir_gangguan;
                $row['durasi_gangguan'] = $histori->durasi_gangguan;
                $row['kategori_gangguan'] = $histori->kategoriGangguan->title;
                $row['hasil_klasifikasi'] = $histori->hasil_klasifikasi_title;
                $row['action'] = $histori->konklusi->title;

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getRestitusi(Request $request)
    {
        $restitusiList = $this->historiGangguanService->getRestitusi($request->all());
        return DataTables::of($restitusiList)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            return view('pages.restitusi.components.action', ['row' => $row]);
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function exportRestitusi(Request $request) 
    {
        $fileName = 'restitusi-'. now()->format('YmdHis') .'.csv';
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = [
            'Bulan', 
            'Lokasi',
            'Durasi Gangguan',
            'Pencapaian Operational (%)',
            'Nilai Restitusi (%)',
            'Nilai Restitusi (Rp.)',
            'Jumlah Akhir',
        ];

        $restitusiList = $this->historiGangguanService->getRestitusi($request->all());
        $list = $restitusiList->get();
        $callback = function() use($list, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns, ';');

            foreach ($list as $restitusi) {
                $row['month'] = MonthHelper::getName($restitusi->month);
                $row['lokasi'] = $restitusi->alamat;
                $row['durasi_gangguan'] = $restitusi->total_durasi;
                $row['capai_kerja'] = ($restitusi->capai_kerja * 100) . '%';
                $row['restitusi_persentase'] = ($restitusi->restitusi_persentase * 100) . '%';
                $row['restitusi'] = $restitusi->restitusi;
                $row['jumlah_akhir'] = $restitusi->jumlah_akhir;

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
