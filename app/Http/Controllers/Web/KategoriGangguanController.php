<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriGangguanRequest;
use App\Services\KategoriGangguanService;
use App\Services\KonklusiService;
use App\Traits\ResponseBuilder;
use Illuminate\Http\Request;

class KategoriGangguanController extends Controller
{
    use ResponseBuilder;

    private $kategoriGangguanService;

    public function __construct(KategoriGangguanService $kategoriGangguanService)
    {
        $this->kategoriGangguanService = $kategoriGangguanService;
    }

    public function index()
    {
        return view('pages.kategori_gangguan.index');
    }

    public function add()
    {
        return view('pages.kategori_gangguan.edit');
    }

    
    public function addKategori(KategoriGangguanRequest $request) 
    {
        $kategoriGangguan = $this->kategoriGangguanService->save($request->validated());
        return redirect('/kategori-gangguan');
    }

    public function edit($id)
    {
        $kategoriGangguan = $this->kategoriGangguanService->getKategoriGangguanById($id);
        return view('pages.kategori_gangguan.edit', [
            'kategori' => $kategoriGangguan,
        ]);
    }

    
    public function editKategori($id, KategoriGangguanRequest $request) 
    {
        $kategoriGangguan = $this->kategoriGangguanService->update($id, $request->validated());
        return redirect('/kategori-gangguan');
    }
}
