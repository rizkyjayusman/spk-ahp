<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\KategoriGangguanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class KategoriGangguanController extends Controller
{
    private $kategoriGangguanService;

    public function __construct(
        KategoriGangguanService $kategoriGangguanService
    ) {
        $this->kategoriGangguanService = $kategoriGangguanService;
    }

    public function index(Request $request)
    {
        $kategoriGangguanList = $this->kategoriGangguanService->getKategoriGangguanList($request->all());

        return DataTables::of($kategoriGangguanList)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            if(Auth::user()->role_id == 1) {
                return view('pages.kategori_gangguan.components.action', ['row' => $row]);
            } else {
                return null;
            }
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(UserRequest $kategoriGangguanRequest)
    {
        $kategoriGangguan = $this->kategoriGangguanService->save($kategoriGangguanRequest);
        
        return Response()->json([
            'success' => true,
            'data' => $kategoriGangguan
        ]);
    }

    public function show($kategoriGangguanId)
    {
        $kategoriGangguan = $this->kategoriGangguanService->getKategoriGangguanById($kategoriGangguanId);

        return Response()->json([
            'success' => true,
            'data' => $kategoriGangguan
        ]);
    }

    public function edit($kategoriGangguanId, UserRequest $kategoriGangguanRequest)
    {
        $kategoriGangguan = $this->kategoriGangguanService->update($kategoriGangguanId, $kategoriGangguanRequest);

        return Response()->json([
            'success' => true,
            'data' => $kategoriGangguan
        ]);
    }

    public function delete($kategoriGangguanId)
    {
        $kategoriGangguan = $this->kategoriGangguanService->delete($kategoriGangguanId);

        return Response()->json([
            'success' => true,
            'data' => []
        ]);
    }
}
