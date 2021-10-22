<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LokasiRequest;
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

    public function addLokasi(LokasiRequest $request) 
    {
        $user = $this->lokasiService->save($request->validated());
        return redirect('/lokasi');
    }

    public function edit($id)
    {
        $lokasi = $this->lokasiService->getLokasiById($id);
        return view('pages.lokasi.edit', [
            'lokasi' => $lokasi,
        ]);
    }

    
    public function editLokasi($id, LokasiRequest $request) 
    {
        $user = $this->lokasiService->update($id, $request->validated());
        return redirect('/lokasi');
    }
}
