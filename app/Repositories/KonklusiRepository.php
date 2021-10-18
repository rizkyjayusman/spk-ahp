<?php

namespace App\Repositories;

use App\Konklusi;
use Illuminate\Http\Request;

class KonklusiRepository
{
    public function __construct()
    {
    }

    public function getKonklusiList($request = [])
    {
        $konklusiList = Konklusi::orderBy('id', 'desc');
        if(isset($request['status'])) {
            $konklusiList->where('status', $request['status']);
        }
        
        return $konklusiList->get();
    }

    public function save($request = [])
    {
        $konklusi = new Konklusi;
        $konklusi->title = $request['title'];
        $konklusi->status = $request['status'];
        return $konklusi->save();
    }

    public function getKonklusiById($id)
    {
        return Konklusi::findOrFail($id);
    }

    public function update($id, $request = [])
    {
        $konklusi = Konklusi::find($id);
        $konklusi->title = $request['title'];
        $konklusi->status = $request['status'];
        return $konklusi->update();
    }

    public function delete($id)
    {
        return Konklusi::find($id)->delete();
    }
}
