<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Produk;
use App\Models\Wisata;
use App\Repositories\Backend\Auth\DesaRepository;
use App\Repositories\Backend\Auth\KecamatanRepository;
use App\Repositories\Backend\Auth\ProdukRepository;
use App\Repositories\Backend\Auth\WisataRepository;

class DesaController extends Controller
{
    protected $desas;
    protected $kecamatans;
    protected $produks;
    protected $wisatas;

    public function __construct(DesaRepository $desas, KecamatanRepository $kecamatans, ProdukRepository $produks, WisataRepository $wisatas)
    {
        $this->desas = $desas;
        $this->kecamatans = $kecamatans;
        $this->produks = $produks;
        $this->wisatas = $wisatas;
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
     * Produk
     */
    public function produkDesaAll(Desa $desa)
    {
        $produks = $desa->produks;
        return view('backend.desa.produk.index', compact(['produks', 'desa']));
    }

    public function produkDesaCreate(Desa $desa)
    {
        $markers = collect(config('gisdesa.value.desa.marker.available'))->mapWithKeys(function($d, $i){
            return [$i => ucfirst($i)];
        })->toArray();
        return view('backend.desa.produk.create', compact(['desa', 'markers']));
    }

    public function produkDesaStore(Request $request, Desa $desa)
    {
        $data = $request->validate([
            'nama'  => ['required'],
            'deskripsi' => ['required'],
            'product_by' => ['required'],
            'product_type' => ['required'],
            'map_lat' => ['required'],
            'map_long' => ['required'],
            'map_bound_coordinates' => ['nullable'],
            'marker_type' => ['nullable'],
            'marker_color' => ['nullable']
        ]);
        // dd($data);
        $desa->produks()->create($data);
        return redirect()->route('admin.desa.produk.index', $desa)->withFlashSuccess('success');
    }

    public function produkDesaShow(Produk $produk)
    {
        return view('backend.desa.produk.show', compact(['produk']));
    }

    public function produkDesaEdit(Request $request, Produk $produk)
    {
        $markers = collect(config('gisdesa.value.desa.marker.available'))->mapWithKeys(function($d, $i){
            return [$i => ucfirst($i)];
        })->toArray();
        if (strtolower($request->method()) == 'post') {
            $data = $request->validate([
                'nama'  => ['required'],
                'deskripsi' => ['required'],
                'product_by' => ['required'],
                'product_type' => ['required'],
                'map_lat' => ['required'],
                'map_long' => ['required'],
                'map_bound_coordinates' => ['nullable'],
                'marker_type' => ['nullable'],
                'marker_color' => ['nullable']
            ]);
            $produk->update($data);
            return redirect()->route('admin.desa.produk.index', $produk->desa)->withFlashSuccess('success');
        }

        return view('backend.desa.produk.edit', compact(['produk', 'markers']));
    }

    public function produkDesaDestroy(Produk $produk)
    {
        $this->produks->deleteById($produk->id);
    }

    /**
     * Wisata
     */
    public function wisataDesaAll(Desa $desa)
    {
        $wisatas = $desa->wisatas;
        return view('backend.desa.wisata.index', compact(['wisatas', 'desa']));
    }

    public function wisataDesaCreate(Desa $desa)
    {
        $markers = collect(config('gisdesa.value.desa.marker.available'))->mapWithKeys(function($d, $i){
            return [$i => ucfirst($i)];
        })->toArray();
        return view('backend.desa.wisata.create', compact(['desa', 'markers']));
    }

    public function wisataDesaStore(Request $request, Desa $desa)
    {
        $data = $request->validate([
            'nama'  => ['required'],
            'deskripsi' => ['required'],
            'manage_by' => ['required'],
            'wisata_type' => ['required'],
            'map_lat' => ['required'],
            'map_long' => ['required'],
            'map_bound_coordinates' => ['nullable'],
            'marker_type' => ['nullable'],
            'marker_color' => ['nullable']
        ]);
        // dd($data);
        $desa->wisatas()->create($data);
        return redirect()->route('admin.desa.wisata.index', $desa)->withFlashSuccess('success');
    }

    public function wisataDesaShow(Wisata $wisata)
    {
        return view('backend.desa.wisata.show', compact(['wisata']));
    }

    public function wisataDesaEdit(Request $request, Wisata $wisata)
    {
        $markers = collect(config('gisdesa.value.desa.marker.available'))->mapWithKeys(function($d, $i){
            return [$i => ucfirst($i)];
        })->toArray();
        if (strtolower($request->method()) == 'post') {
            $data = $request->validate([
                'nama'  => ['required'],
                'deskripsi' => ['required'],
                'manage_by' => ['required'],
                'wisata_type' => ['required'],
                'map_lat' => ['required'],
                'map_long' => ['required'],
                'map_bound_coordinates' => ['nullable'],
                'marker_type' => ['nullable'],
                'marker_color' => ['nullable']
            ]);
            $wisata->update($data);
            return redirect()->route('admin.desa.wisata.index', $wisata->desa)->withFlashSuccess('success');
        }

        return view('backend.desa.wisata.edit', compact(['wisata', 'markers']));
    }

    public function wisataDesaDestroy(Wisata $wisata)
    {
        $this->wisatas->deleteById($wisata->id);
    }
}
