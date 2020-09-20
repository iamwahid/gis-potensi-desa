<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Produk;
use App\Repositories\Backend\Auth\ProdukRepository;

class ProdukController extends Controller
{
    protected $produks;

    public function __construct(ProdukRepository $produks)
    {
        $this->produks = $produks;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Desa $desa)
    {
        return view('backend.produk.index', ['produks' => $this->produks->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Desa $desa)
    {
        return view('backend.produk.create');
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

        $this->produks->create($data);
        return redirect()->route('admin.produk.index')->withFlashSuccess('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa, Produk $produk)
    {
        return view('backend.produk.show', ['produk' => $produk]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa, Produk $produk)
    {
        return view('backend.produk.edit', ['produk' => $produk]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa, Produk $produk)
    {
        $data = $request->validate([
            
        ]);

        $this->produks->updateById($produk->id, $data);
        return redirect()->route('admin.produk.index')->withFlashSuccess('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa, Produk $produk)
    {
        $this->produks->deleteById($produk->id);
    }
}
