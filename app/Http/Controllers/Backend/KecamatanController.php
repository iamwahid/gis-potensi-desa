<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Repositories\Backend\Auth\KecamatanRepository;

class KecamatanController extends Controller
{
    protected $kecamatans;

    public function __construct(KecamatanRepository $kecamatans)
    {
        $this->kecamatans = $kecamatans;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.kecamatan.index', ['kecamatans' => $this->kecamatans->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kecamatan.create');
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

        $this->kecamatans->create($data);
        return redirect()->route('admin.kecamatan.index')->withFlashSuccess('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        return view('backend.kecamatan.show', ['kecamatan' => $kecamatan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        return view('backend.kecamatan.edit', ['kecamatan' => $kecamatan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $data = $request->validate([
            
        ]);

        $this->kecamatans->updateById($kecamatan->id, $data);
        return redirect()->route('admin.kecamatan.index')->withFlashSuccess('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $this->kecamatans->deleteById($kecamatan->id);
    }
}
