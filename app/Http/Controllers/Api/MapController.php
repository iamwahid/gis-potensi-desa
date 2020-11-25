<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\DesaRepository;
use App\Repositories\Backend\Auth\KecamatanRepository;
use App\Repositories\Backend\Auth\PotencyRepository;
use Request;

/**
 * Class MapController.
 */
class MapController extends Controller
{

    protected $desas;
    protected $potencies;
    protected $kecamatans;

    public function __construct(DesaRepository $desas, PotencyRepository $potencies, KecamatanRepository $kecamatans)
    {
        $this->desas = $desas;
        $this->potencies = $potencies;
        $this->kecamatans = $kecamatans;
    }

    public function mapDesa()
    {
        return $this->desas->getMapDesa();
    }

    public function mapDesaById($id)
    {
        return $this->desas->getMapById($id);
    }

    public function mapDesaByKecId($id)
    {
        return $this->desas->getMapByKecId($id);
    }

    public function mapPotency()
    {
        return $this->potencies->getMapPotency();
    }

    public function mapPotencyById($id)
    {
        return $this->potencies->getMapById($id);
    }

    public function mapPotencyByDesaId($id)
    {
        return $this->potencies->getMapByDesaId($id);
    }

    public function mapPotencyByKecId($id)
    {
        return $this->potencies->getMapByKecId($id);
    }

    public function getKecLatLng()
    {
        return $this->kecamatans->get(['id', 'nama', 'map_lat', 'map_long'])->map(function($d){
            $d->nama = strtoupper($d->nama);
            return $d;
        });
    }

    public function mapSearch()
    {
        $keys = request()->validate([
            'keyword' => 'nullable|string',
            'type' => 'nullable',
            'category' => 'nullable',
            'desa_id' => 'nullable',
            'kec_id' => 'nullable'
        ]);
        return toGeoJSON($this->potencies->searchBy($keys));
    }
}
