<?php

namespace App\Repositories;

use App\Lokasi;

class LokasiRepository
{
    public function __construct()
    {
    }

    public function getLokasiList($request = [])
    {
        return Lokasi::orderBy('id', 'desc')->get();
    }

    public function save($request = [])
    {
        $lokasi = new Lokasi;
        $lokasi->alamat = $request['alamat'];
        return $lokasi->save();
    }

    public function getLokasiById($id)
    {
        return Lokasi::findOrFail($id);
    }

    public function update($id, $request = [])
    {
        $lokasi = Lokasi::find($id);
        $lokasi->alamat = $request['alamat'];
        return $lokasi->update();
    }

    public function delete($id)
    {
        return Lokasi::find($id)->delete();
    }

    public function getTotalLokasi() {
        return Lokasi::all()->count();
    }

}
