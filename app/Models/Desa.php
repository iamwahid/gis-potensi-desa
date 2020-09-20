<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $fillable = [
        'nama',
        'kec_id',
        'penduduk_total',
        'map_lat',
        'map_long',
        'map_bound_coordinates'
    ];

    protected $appends = [
        'mapcontent'
	];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kec_id');
    }

    public function produks()
    {
        return $this->hasMany(Produk::class, 'desa_id');
    }

    public function wisatas()
    {
        return $this->hasMany(Wisata::class, 'desa_id');
    }

    public function getActionButtonsAttribute()
    {
        $show = route('admin.desa.show', $this->id);
        $edit = route('admin.desa.edit', $this->id);
        $delete = route('admin.desa.destroy', $this->id);
        $produk = route('admin.desa.produk.index', $this->id);
        $html = 
<<<HTML
        <div class="btn-group">
        <a href="$show" class="btn btn-success">Lihat</a>
        <a href="$edit" class="btn btn-primary">Edit</a>
        <a href="$produk" class="btn btn-primary">Produk</a>
        <a href="$delete" class="btn btn-danger delete-item disabled">Hapus</a>
        </div>
HTML;
        return $html;
    }

    public function getMapcontentAttribute()
    {   
        $props = [
            'Desa : '. $this->nama,
            'Kecamatan : '.$this->kecamatan->nama,
            'Kabupaten : '.$this->kecamatan->kabupaten,
            'Koordinat : '.$this->map_lat.', '.$this->map_long
        ];
        $links = [
            route('admin.desa.show', $this->id) => 'Lihat Detail',
        ];
        $content = view('components.map.popup', compact(['props', 'links']))->render();
        return $content;
    }
}