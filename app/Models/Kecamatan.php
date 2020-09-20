<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = [
        'nama',
        'penduduk_total',
        'kabupaten',
        'provinsi',
        'map_lat',
        'map_long',
        'map_bound_coordinates'
    ];
}
