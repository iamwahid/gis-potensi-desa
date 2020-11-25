<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\DesaRepository;
use App\Repositories\Backend\Auth\KecamatanRepository;
use App\Repositories\Backend\Auth\PotencyRepository;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    protected $desas;
    protected $kecamatans;
    protected $potencies;

    public function __construct(DesaRepository $desas, KecamatanRepository $kecamatans, PotencyRepository $potencies)
    {
        $this->desas = $desas;
        $this->kecamatans = $kecamatans;
        $this->potencies = $potencies;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $ddesa = $this->desas->get();
        $kec_desa = $this->kecamatans->get()->mapWithKeys(function($d) use ($ddesa){
            $kec = ['optbold_'.$d->id => 'Kec. '.$d->nama];
            $desa = $ddesa->where('kec_id', $d->id)->pluck('nama', 'id')->mapWithKeys(function($it, $key){
                return [$key.'_' => $it];
            })->toArray();
            return [$d->id => $kec + $desa];
        })->flatMap(function($d){
            return $d;
        })->toArray();
        $potensi = [];
        foreach (config('gisdesa.value.desa.potency.potency_type') as $k => $v) {
            $potensi = $potensi + ['optbold_'.$k => $v]; //+ config('gisdesa.value.desa.potency.potency_category')[$v];
        }
        return view('backend.dashboard', compact(['kec_desa', 'potensi']));
    }
}
