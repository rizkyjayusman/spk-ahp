<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\LokasiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class LokasiController extends Controller
{
    private $lokasiService;

    public function __construct(
        LokasiService $lokasiService
    ) {
        $this->lokasiService = $lokasiService;
    }

    public function index()
    {
        $lokasiList = $this->lokasiService->getLokasiList();

        return DataTables::of($lokasiList)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            if(Auth::user()->role_id == 1) {
                return view('pages.lokasi.components.action', ['row' => $row]);
            } else {
                return null;
            }
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(UserRequest $lokasiRequest)
    {
        $lokasi = $this->lokasiService->save($lokasiRequest);
        
        return Response()->json([
            'success' => true,
            'data' => $lokasi
        ]);
    }

    public function show($lokasiId)
    {
        $lokasi = $this->lokasiService->getLokasiById($lokasiId);

        return Response()->json([
            'success' => true,
            'data' => $lokasi
        ]);
    }

    public function edit($lokasiId, UserRequest $lokasiRequest)
    {
        $lokasi = $this->lokasiService->update($lokasiId, $lokasiRequest);

        return Response()->json([
            'success' => true,
            'data' => $lokasi
        ]);
    }

    public function delete($lokasiId)
    {
        $user = $this->lokasiService->delete($lokasiId);

        return Response()->json([
            'success' => true,
            'data' => []
        ]);
    }
}
