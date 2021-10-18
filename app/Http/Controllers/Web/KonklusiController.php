<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\KonklusiService;
use App\Traits\ResponseBuilder;
use Illuminate\Http\Request;

class KonklusiController extends Controller
{
    use ResponseBuilder;

    private $konklusiService;

    public function __construct(KonklusiService $konklusiService)
    {
        $this->konklusiService = $konklusiService;
    }

    public function index()
    {
        return view('pages.konklusi.index');
    }

    public function add()
    {
        return view('pages.konklusi.edit');
    }

    public function addKonklusi(Request $request) 
    {
        $konklusi = $this->konklusiService->save($request->all());
        return redirect('/konklusi');
    }

    public function edit($id)
    {
        $konklusi = $this->konklusiService->getKonklusiById($id);
        return view('pages.konklusi.edit', [
            'konklusi' => $konklusi,
        ]);
    }
        
    public function editKonklusi($id, Request $request) 
    {
        $konklusi = $this->konklusiService->update($id, $request->all());
        return redirect('/konklusi');
    }
}
