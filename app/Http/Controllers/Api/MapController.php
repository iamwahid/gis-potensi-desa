<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\DesaRepository;
use App\Repositories\Backend\Auth\ProdukRepository;
use App\Repositories\Backend\Auth\WisataRepository;

/**
 * Class MapController.
 */
class MapController extends Controller
{

    protected $desas;
    protected $produks;
    protected $wisatas;

    public function __construct(DesaRepository $desas, ProdukRepository $produks, WisataRepository $wisatas)
    {
        $this->desas = $desas;
        $this->produks = $produks;
        $this->wisatas = $wisatas;
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

    public function mapProduk()
    {
        return $this->produks->getMapProduk();
    }

    public function mapProdukById($id)
    {
        return $this->produks->getMapById($id);
    }

    public function mapProdukByDesaId($id)
    {
        return $this->produks->getMapByDesaId($id);
    }

    public function mapWisata()
    {
        return $this->wisatas->getMapWisata();
    }

    public function mapWisataById($id)
    {
        return $this->wisatas->getMapById($id);
    }

    public function mapWisataByDesaId($id)
    {
        return $this->wisatas->getMapByDesaId($id);
    }
}
