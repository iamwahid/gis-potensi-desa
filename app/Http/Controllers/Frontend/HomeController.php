<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\DesaRepository;
use App\Repositories\Backend\Auth\KecamatanRepository;
use App\Repositories\Backend\Auth\PotencyRepository;

/**
 * Class HomeController.
 */
class HomeController extends Controller
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
        return view('frontend.index');
    }

    public function mapView()
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
            $potensi = $potensi + ['optbold_'.$k => $v] + config('gisdesa.value.desa.potency.potency_category')[$v];
        }
        return view('frontend.map', compact(['kec_desa', 'potensi']));
    }
}
