<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Repositories\Backend\Auth\WisataRepository;

class WisataController extends Controller
{
    protected $wisatas;

    public function __construct(WisataRepository $wisatas)
    {
        $this->wisatas = $wisatas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.wisata.index', ['wisatas' => $this->wisatas->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.wisata.create');
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

        $this->wisatas->create($data);
        return redirect()->route('admin.wisata.index')->withFlashSuccess('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Wisata $wisata)
    {
        return view('backend.wisata.show', ['wisata' => $wisata]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $wisata
     * @return \Illuminate\Http\Response
     */
    public function edit(Wisata $wisata)
    {
        return view('backend.wisata.edit', ['wisata' => $wisata]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $wisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wisata $wisata)
    {
        $data = $request->validate([
            
        ]);

        $this->wisatas->updateById($wisata->id, $data);
        return redirect()->route('admin.wisata.index')->withFlashSuccess('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $wisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wisata $wisata)
    {
        $this->wisatas->deleteById($wisata->id);
    }
}
