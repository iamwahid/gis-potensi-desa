<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Potency extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'desa_id',
        'managed_by', // pengelola | perorangan | kelompok
        'potency_type', // potency, wisata
        'potency_category', // pemandangan, telaga, | kerajinan, makanan, minuman
        'potency_source', // alam, buatan
        'is_draft', // masih konsep
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
            'Nama Potensi : '. $this->nama,
            'Deskripsi Potensi : '.$this->deskripsi,
            'Koordinat : '.$this->map_lat.', '.$this->map_long,
        ];
        $links = [
            route('admin.desa.potency.show', $this->id) => 'Lihat Detail',
        ];
        $content = view('components.map.popup', compact(['props', 'links']))->render();
        return $content;
    }

    public function getManagedByAttribute()
    {
        if ($this->attributes['managed_by']) return config('gisdesa.value.desa.potency.managed_by')[$this->attributes['managed_by']];
    }

    public function getPotencyTypeAttribute()
    {
        if ($this->attributes['potency_type']) return config('gisdesa.value.desa.potency.potency_type')[$this->attributes['potency_type']];
    }

    public function getActionButtonsAttribute()
    {
        $show = route('admin.desa.potency.show', $this->id);
        $edit = route('admin.desa.potency.edit', $this->id);
        $delete = route('admin.desa.potency.destroy', $this->id);
        $html = 
<<<HTML
        <div class="btn-group">
        <a href="$show" class="btn btn-success">Lihat</a>
        <a href="$edit" class="btn btn-primary">Edit</a>
        <a href="$delete" class="btn btn-danger" data-method="delete">Hapus</a>
        </div>
HTML;
        return $html;
    }

    public function scopeKeyword($query, $keyword = '')
    {
        return $query->where('nama', 'like', '%'.$keyword.'%')->orWhere('deskripsi', 'like', '%'.$keyword.'%');
    }

    public function scopeType($query, $type = null)
    {
        if (!$type) return $query;
        return $query->where('potency_type', $type);
    }

    public function scopeCategory($query, $category = null)
    {
        if (!$category) return $query;
        return $query->where('potency_category', $category);
    }

    public function scopeDesa($query, $desa_id = null)
    {
        if (!$desa_id) return $query;
        return $query->where('desa_id', $desa_id);
    }

    public function scopeKecamatan($query, $kec_id = null)
    {
        if (!$kec_id) return $query;
        return $query->whereHas('desa', function($d) use ($kec_id) {
            return $d->where('kec_id', $kec_id);
        });
    }
}
