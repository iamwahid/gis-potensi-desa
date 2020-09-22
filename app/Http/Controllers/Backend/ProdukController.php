<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Potency;
use App\Repositories\Backend\Auth\PotencyRepository;

class PotencyController extends Controller
{
    protected $potencies;

    public function __construct(PotencyRepository $potencies)
    {
        $this->potencies = $potencies;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Desa $desa)
    {
        return view('backend.potency.index', ['potencies' => $this->potencies->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Desa $desa)
    {
        return view('backend.potency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Desa $desa)
    {
        $data = $request->validate([
            
        ]);

        $this->potencies->create($data);
        return redirect()->route('admin.potency.index')->withFlashSuccess('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa, Potency $potency)
    {
        return view('backend.potency.show', ['potency' => $potency]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $potency
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa, Potency $potency)
    {
        return view('backend.potency.edit', ['potency' => $potency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $potency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa, Potency $potency)
    {
        $data = $request->validate([
            
        ]);

        $this->potencies->updateById($potency->id, $data);
        return redirect()->route('admin.potency.index')->withFlashSuccess('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $potency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa, Potency $potency)
    {
        $this->potencies->deleteById($potency->id);
    }
}
