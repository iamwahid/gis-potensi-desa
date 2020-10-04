<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Potency;
use App\Models\Wisata;
use App\Repositories\Backend\Auth\DesaRepository;
use App\Repositories\Backend\Auth\KecamatanRepository;
use App\Repositories\Backend\Auth\PotencyRepository;

class DesaController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kec_desa = request()->get('kec_desa_id') ?: '';
        $kec_desa = explode('_', $kec_desa);
        if ($kec_desa && $kec_desa[0] == 'optbold') {
            $kec = $kec_desa[1];
            $desa = null;
        } else {
            $kec = null;
            $desa = $kec_desa[0];
        }
        $desas = $this->desas->kecamatan($kec)->id($desa)->paginate(30);
        $kecamatans = $this->kecamatans->get();
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


        return view('backend.desa.index', compact(['desas', 'kec_desa']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatans = $this->kecamatans->get()->pluck('nama', 'id')->toArray();
        return view('backend.desa.create', compact(['kecamatans']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'penduduk_total' => 'nullable',
            'penduduk_pria' => 'nullable',
            'penduduk_wanita' => 'nullable',
            'penduduk_produktif' => 'nullable',
            'penduduk_work_formal' => 'nullable',
            'penduduk_work_informal' => 'nullable',
            'penduduk_work_none' => 'nullable',
            'penduduk_sector_agriculture' => 'nullable',
            'penduduk_sector_mining' => 'nullable',
            'penduduk_sector_industry' => 'nullable',
            'penduduk_sector_construction' => 'nullable',
            'penduduk_sector_trade' => 'nullable',
            'penduduk_sector_service' => 'nullable',
            'penduduk_sector_transportation' => 'nullable',
            'penduduk_edu_none' => 'nullable',
            'penduduk_edu_sd' => 'nullable',
            'penduduk_edu_smp' => 'nullable',
            'penduduk_edu_sma' => 'nullable',
            'penduduk_edu_s1' => 'nullable',
            'penduduk_edu_s2' => 'nullable',
            'penduduk_edu_s3' => 'nullable',
            'penduduk_religion_islam' => 'nullable',
            'penduduk_religion_protestan' => 'nullable',
            'penduduk_religion_katolik' => 'nullable',
            'penduduk_religion_hindu' => 'nullable',
            'penduduk_religion_buddha' => 'nullable',
            'penduduk_religion_lain' => 'nullable',
            'penduduk_dis_blind' => 'nullable',
            'penduduk_dis_deaf' => 'nullable',
            'penduduk_dis_mute' => 'nullable',
            'penduduk_dis_body' => 'nullable',
            'penduduk_dis_mental' => 'nullable',
            'penduduk_persen_kecamatan' => 'nullable',
            'penduduk_padat_km2' => 'nullable',
            'rts_raskin' => 'nullable',
            'rts_jamkesmas' => 'nullable',
            'rts_pkh' => 'nullable',
            'rts_blsm' => 'nullable',
            'letak_tinggi_kantor_desa' => 'nullable',
            'luas_wilayah' => 'nullable',
            'luas_persen_kecamatan' => 'nullable',
        ]);

        // $this->desas->create($data);
        return redirect()->route('admin.desa.index')->withFlashSuccess('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa)
    {
        return view('backend.desa.show', ['desa' => $desa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        $kecamatans = $this->kecamatans->get()->pluck('nama', 'id')->toArray();
        return view('backend.desa.edit', compact(['desa', 'kecamatans']));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa)
    {
        $data = $request->validate([
            'nama' => 'required',
            'penduduk_total' => 'nullable',
            'penduduk_pria' => 'nullable',
            'penduduk_wanita' => 'nullable',
            'penduduk_produktif' => 'nullable',
            'penduduk_work_formal' => 'nullable',
            'penduduk_work_informal' => 'nullable',
            'penduduk_work_none' => 'nullable',
            'penduduk_sector_agriculture' => 'nullable',
            'penduduk_sector_mining' => 'nullable',
            'penduduk_sector_industry' => 'nullable',
            'penduduk_sector_construction' => 'nullable',
            'penduduk_sector_trade' => 'nullable',
            'penduduk_sector_service' => 'nullable',
            'penduduk_sector_transportation' => 'nullable',
            'penduduk_edu_none' => 'nullable',
            'penduduk_edu_sd' => 'nullable',
            'penduduk_edu_smp' => 'nullable',
            'penduduk_edu_sma' => 'nullable',
            'penduduk_edu_s1' => 'nullable',
            'penduduk_edu_s2' => 'nullable',
            'penduduk_edu_s3' => 'nullable',
            'penduduk_religion_islam' => 'nullable',
            'penduduk_religion_protestan' => 'nullable',
            'penduduk_religion_katolik' => 'nullable',
            'penduduk_religion_hindu' => 'nullable',
            'penduduk_religion_buddha' => 'nullable',
            'penduduk_religion_lain' => 'nullable',
            'penduduk_dis_blind' => 'nullable',
            'penduduk_dis_deaf' => 'nullable',
            'penduduk_dis_mute' => 'nullable',
            'penduduk_dis_body' => 'nullable',
            'penduduk_dis_mental' => 'nullable',
            'penduduk_persen_kecamatan' => 'nullable',
            'penduduk_padat_km2' => 'nullable',
            'rts_raskin' => 'nullable',
            'rts_jamkesmas' => 'nullable',
            'rts_pkh' => 'nullable',
            'rts_blsm' => 'nullable',
            'letak_tinggi_kantor_desa' => 'nullable',
            'luas_wilayah' => 'nullable',
            'luas_persen_kecamatan' => 'nullable',
        ]);

        $this->desas->updateById($desa->id, $data);
        return redirect()->route('admin.desa.index')->withFlashSuccess('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa)
    {
        // $this->desas->deleteById($desa->id);
    }

    /**
     * Potency
     */
    public function potencyDesaAll(Desa $desa)
    {
        $potencies = $desa->potencies;
        return view('backend.desa.potency.index', compact(['potencies', 'desa']));
    }

    public function potencyDesaCreate(Desa $desa)
    {
        $markers = collect(config('gisdesa.value.desa.marker.available'))->mapWithKeys(function($d, $i){
            return [$i => ucfirst($i)];
        })->toArray();
        return view('backend.desa.potency.create', compact(['desa', 'markers']));
    }

    public function potencyDesaStore(Request $request, Desa $desa)
    {
        $data = $request->validate([
            'nama'  => ['required'],
            'deskripsi' => ['required'],
            'managed_by' => ['nullable'],
            'potency_type' => ['nullable'],
            'potency_category' => ['nullable'],
            'potency_source' => ['nullable'],
            'is_draft' => ['nullable'],
            'map_lat' => ['required'],
            'map_long' => ['required'],
            'map_bound_coordinates' => ['nullable'],
            'marker_type' => ['nullable'],
            'marker_color' => ['nullable']
        ]);
        // dd($data);
        $desa->potencies()->create($data);
        return redirect()->route('admin.desa.potency.index', $desa)->withFlashSuccess('success');
    }

    public function potencyDesaShow(Potency $potency)
    {
        return view('backend.desa.potency.show', compact(['potency']));
    }

    public function potencyDesaEdit(Request $request, Potency $potency)
    {
        $markers = collect(config('gisdesa.value.desa.marker.available'))->mapWithKeys(function($d, $i){
            return [$i => ucfirst($i)];
        })->toArray();
        if (strtolower($request->method()) == 'post') {
            $data = $request->validate([
                'nama'  => ['required'],
                'deskripsi' => ['required'],
                'managed_by' => ['nullable'],
                'potency_type' => ['nullable'],
                'potency_category' => ['nullable'],
                'potency_source' => ['nullable'],
                'is_draft' => ['nullable'],
                'map_lat' => ['required'],
                'map_long' => ['required'],
                'map_bound_coordinates' => ['nullable'],
                'marker_type' => ['nullable'],
                'marker_color' => ['nullable']
            ]);

            // dd($data);
            $potency->update($data);
            return redirect()->route('admin.desa.potency.index', $potency->desa)->withFlashSuccess('success');
        }

        return view('backend.desa.potency.edit', compact(['potency', 'markers']));
    }

    public function potencyDesaDestroy(Potency $potency)
    {
        $this->potencies->deleteById($potency->id);
    }
}
