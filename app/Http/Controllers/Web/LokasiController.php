<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\LokasiService;
use App\Traits\ResponseBuilder;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    use ResponseBuilder;

    private $lokasiService;

    public function __construct(LokasiService $lokasiService)
    {
        $this->lokasiService = $lokasiService;
    }

    public function index()
    {
        return view('pages.lokasi.index');
    }

    public function add()
    {
        return view('pages.lokasi.edit');
    }

    public function addLokasi(Request $request) 
    {
        $user = $this->lokasiService->save($request->all());
        return redirect('/lokasi');
    }

    public function edit($id)
    {
        $lokasi = $this->lokasiService->getLokasiById($id);
        return view('pages.lokasi.edit', [
            'lokasi' => $lokasi,
        ]);
    }

    
    public function editLokasi($id, Request $request) 
    {
        $user = $this->lokasiService->update($id, $request->all());
        return redirect('/lokasi');
    }
}
