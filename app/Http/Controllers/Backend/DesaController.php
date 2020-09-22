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
        $desas = $this->desas->paginate();
        $kecamatans = $this->kecamatans->get();
        return view('backend.desa.index', compact(['desas', 'kecamatans']));
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
            
        ]);

        // $this->desas->updateById($desa->id, $data);
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
