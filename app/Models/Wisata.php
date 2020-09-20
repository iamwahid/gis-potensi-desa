<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'desa_id',
        'manage_by',
        'wisata_type',
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
            'Nama Wisata : '. $this->nama,
            'Deskripsi Wisata : '.$this->deskripsi,
            'Koordinat : '.$this->map_lat.', '.$this->map_long
        ];
        $links = [];
        $content = view('components.map.popup', compact(['props', 'links']))->render();
        return $content;
    }
}
