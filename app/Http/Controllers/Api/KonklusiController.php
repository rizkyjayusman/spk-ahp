<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\KonklusiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class KonklusiController extends Controller
{
    private $konklusiService;

    public function __construct(
        KonklusiService $konklusiService
    ) {
        $this->konklusiService = $konklusiService;
    }

    public function index(Request $request)
    {
        $konklusiList = $this->konklusiService->getKonklusiList($request->all());

        return DataTables::of($konklusiList)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            if(Auth::user()->role_id == 1) {
                return view('pages.konklusi.components.action', ['row' => $row]);
            } else {
                return null;
            }
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(UserRequest $konklusiRequest)
    {
        $konklusi = $this->konklusiService->save($konklusiRequest);
        
        return Response()->json([
            'success' => true,
            'data' => $konklusi
        ]);
    }

    public function show($konklusiId)
    {
        $konklusi = $this->konklusiService->getKonklusiById($konklusiId);

        return Response()->json([
            'success' => true,
            'data' => $konklusi
        ]);
    }

    public function edit($konklusiId, UserRequest $konklusiRequest)
    {
        $konklusi = $this->konklusiService->update($konklusiId, $konklusiRequest);

        return Response()->json([
            'success' => true,
            'data' => $konklusi
        ]);
    }

    public function delete($konklusiId)
    {
        $konklusi = $this->konklusiService->delete($konklusiId);

        return Response()->json([
            'success' => true,
            'data' => []
        ]);
    }
}
