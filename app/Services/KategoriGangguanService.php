<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\HistoriGangguanRepository;
use App\Repositories\KategoriGangguanRepository;
use Illuminate\Http\Request;

class KategoriGangguanService
{
    private $kategoriGangguanRepository;

    public function __construct(KategoriGangguanRepository $kategoriGangguanRepository)
    {
        $this->kategoriGangguanRepository = $kategoriGangguanRepository;
    }

    public function getKategoriGangguanList($request = [])
    {
        return $this->kategoriGangguanRepository->getKategoriGangguanList($request);
    }

    public function save($request = [])
    {
        return $this->kategoriGangguanRepository->save($request);
    }

    public function getKategoriGangguanById($id)
    {
        return $this->kategoriGangguanRepository->getKategoriGangguanById($id);
    }

    public function update($id, $request = [])
    {
        return $this->kategoriGangguanRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->kategoriGangguanRepository->delete($id);
    }
    
    public function getTotalKategori() {
        return $this->kategoriGangguanRepository->getTotalKategori();
    }
}
