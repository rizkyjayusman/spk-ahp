<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\HistoriGangguanRequest;
use App\Services\HistoriGangguanService;
use App\Services\KategoriGangguanService;
use App\Services\KonklusiService;
use App\Services\LokasiService;
use App\Traits\ResponseBuilder;
use Illuminate\Http\Request;

class HistoriGangguanController extends Controller
{
    use ResponseBuilder;

    private $historiGangguanService;
    private $lokasiService;
    private $kategoriGangguanService;
    private $konklusiService;

    public function __construct(HistoriGangguanService $historiGangguanService,
        LokasiService $lokasiService,
        KategoriGangguanService $kategoriGangguanService,
        KonklusiService $konklusiService)
    {
        $this->historiGangguanService = $historiGangguanService;
        $this->lokasiService = $lokasiService;
        $this->kategoriGangguanService = $kategoriGangguanService;
        $this->konklusiService = $konklusiService;
    }

    public function index()
    {
        return view('pages.histori_gangguan.index');
    }

    public function add()
    {
        $lokasiList = $this->lokasiService->getLokasiList();
        $kategoriGangguanList = $this->kategoriGangguanService->getKategoriGangguanList(['status' => true]);
        $konklusiList = $this->konklusiService->getKonklusiList(['status' => true]);
        return view('pages.histori_gangguan.edit', [
            'lokasi' => $lokasiList,
            'kategori_gangguan' => $kategoriGangguanList,
            'konklusi' => $konklusiList,
        ]);
    }
    
    public function addHistori(HistoriGangguanRequest $request) 
    {
        $historiGangguan = $this->historiGangguanService->save($request->all());
        return redirect('/histori-gangguan');
    }


    public function edit($id)
    {
        $lokasiList = $this->lokasiService->getLokasiList();
        $kategoriGangguanList = $this->kategoriGangguanService->getKategoriGangguanList(['status' => true]);
        $konklusiList = $this->konklusiService->getKonklusiList(['status' => true]);
        $historiGangguan = $this->historiGangguanService->getHistoriGangguanById($id);
        return view('pages.histori_gangguan.edit', [
            'histori_gangguan' => $historiGangguan,
            'lokasi' => $lokasiList,
            'kategori_gangguan' => $kategoriGangguanList,
            'konklusi' => $konklusiList,
        ]);
    }

    public function editHistori($id, HistoriGangguanRequest $request) 
    {
        $konklusi = $this->historiGangguanService->update($id, $request->validated());
        return redirect('/histori-gangguan');
    }
}
