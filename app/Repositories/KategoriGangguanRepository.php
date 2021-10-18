<?php

namespace App\Repositories;

use App\KategoriGangguan;
use Illuminate\Http\Request;

class KategoriGangguanRepository
{
    public function __construct()
    {
    }

    public function getKategoriGangguanList($request = [])
    {
        $kategoriGangguanList = KategoriGangguan::orderBy('id', 'desc');
        if(isset($request['status'])) {
            $kategoriGangguanList->where('status', $request['status']);
        }
        
        return $kategoriGangguanList->get();
    }

    public function save($request = [])
    {
        $kategoriGangguan = new KategoriGangguan;
        $kategoriGangguan->title = $request['title'];
        $kategoriGangguan->status = $request['status'];
        return $kategoriGangguan->save();
    }

    public function getKategoriGangguanById($id)
    {
        return KategoriGangguan::findOrFail($id);
    }

    public function update($id, $request = [])
    {
        $kategoriGangguan = KategoriGangguan::find($id);
        $kategoriGangguan->title = $request['title'];
        $kategoriGangguan->status = $request['status'];
        return $kategoriGangguan->update();
    }

    public function delete($id)
    {
        return KategoriGangguan::find($id)->delete();
    }
}
