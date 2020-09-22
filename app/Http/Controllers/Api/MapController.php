<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\DesaRepository;
use App\Repositories\Backend\Auth\PotencyRepository;

/**
 * Class MapController.
 */
class MapController extends Controller
{

    protected $desas;
    protected $potencies;

    public function __construct(DesaRepository $desas, PotencyRepository $potencies)
    {
        $this->desas = $desas;
        $this->potencies = $potencies;
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
}
