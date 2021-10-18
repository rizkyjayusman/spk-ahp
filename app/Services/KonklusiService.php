<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\KonklusiRepository;
use App\Repositories\LokasiRepository;
use Illuminate\Http\Request;

class KonklusiService
{
    private $konklusiRepository;

    public function __construct(KonklusiRepository $konklusiRepository)
    {
        $this->konklusiRepository = $konklusiRepository;
    }

    public function getKonklusiList($request = [])
    {
        return $this->konklusiRepository->getKonklusiList($request);
    }

    public function save($request = [])
    {
        return $this->konklusiRepository->save($request);
    }

    public function getKonklusiById($id)
    {
        return $this->konklusiRepository->getKonklusiById($id);
    }

    public function update($id, $request = [])
    {
        return $this->konklusiRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->konklusiRepository->delete($id);
    }
}
