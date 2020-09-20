<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'desa_id',
        'product_by',
        'product_type',
        'map_lat',
        'map_long',
        'map_bound_coordinates',
        'marker_type',
        'marker_color'
    ];

    protected $appends = [
        'mapcontent',
	];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function getMapcontentAttribute()
    {
        $props = [
            'Nama Produk : '. $this->nama,
            'Deskripsi Produk : '.$this->deskripsi,
            'Koordinat : '.$this->map_lat.', '.$this->map_long,
        ];
        $links = [
            route('admin.desa.produk.show', $this->id) => 'Lihat Detail',
        ];
        $content = view('components.map.popup', compact(['props', 'links']))->render();
        return $content;
    }

    public function getProductByAttribute()
    {
        if ($this->attributes['product_by']) return config('gisdesa.value.desa.produk.by')[$this->attributes['product_by']];
    }

    public function getProductTypeAttribute()
    {
        if ($this->attributes['product_type']) return config('gisdesa.value.desa.produk.type')[$this->attributes['product_type']];
    }

    public function getActionButtonsAttribute()
    {
        $show = route('admin.desa.produk.show', $this->id);
        $edit = route('admin.desa.produk.edit', $this->id);
        $delete = route('admin.desa.produk.destroy', $this->id);
        $html = 
<<<HTML
        <div class="btn-group">
        <a href="$show" class="btn btn-success">Lihat</a>
        <a href="$edit" class="btn btn-primary">Edit</a>
        <a href="$delete" class="btn btn-danger delete-item">Hapus</a>
        </div>
HTML;
        return $html;
    }
}
