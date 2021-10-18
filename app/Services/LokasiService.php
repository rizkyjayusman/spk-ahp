<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\LokasiRepository;

class LokasiService
{
    private $lokasiRepository;

    public function __construct(LokasiRepository $lokasiRepository)
    {
        $this->lokasiRepository = $lokasiRepository;
    }

    public function getLokasiList($request = [])
    {
        return $this->lokasiRepository->getLokasiList($request);
    }

    public function save($request = [])
    {
        return $this->lokasiRepository->save($request);
    }

    public function getLokasiById($id)
    {
        return $this->lokasiRepository->getLokasiById($id);
    }

    public function update($id, $request = [])
    {
        return $this->lokasiRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->lokasiRepository->delete($id);
    }
    
    public function getTotalLokasi() {
        return $this->lokasiRepository->getTotalLokasi();
    }
}
