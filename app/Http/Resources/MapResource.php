<?php

namespace App\Http\Resources;

use App\Models\Desa;
use App\Models\Produk;
use App\Models\Wisata;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    protected $type;
    public function __construct($resource)
    {
        $this->resource = $resource;

        if ($resource instanceof Desa) $this->type = 'desa';
        else if ($resource instanceof Produk) $this->type = 'produk';
        else if ($resource instanceof Wisata) $this->type = 'wisata';
        else $this->type = '';
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        switch ($this->type) {
            case 'desa':
                $res = [
                    'desa_id' => $this->id,
                    'kec_id' => $this->kec_id,
                    'desa' => $this->nama,
                    'kecamatan' => $this->kecamatan->nama,
                    'kabupaten' => $this->kecamatan->kabupaten,
                    'provinsi' => $this->kecamatan->provinsi,
                    'penduduk_total' => $this->penduduk_total,
                    'map_lat' => $this->map_lat,
                    'map_long' => $this->map_long,
                    'map_content' => $this->mapcontent
                ];
                break;
            case 'produk':
                $res = [
                    'produk_id' => $this->id,
                    'desa_id' => $this->desa->id,
                    'kec_id' => $this->desa->kec_id,
                    'nama_produk' => $this->nama,
                    'deskripsi_produk' => $this->deskripsi,
                    'desa' => $this->desa->nama,
                    'kecamatan' => $this->desa->kecamatan->nama,
                    'kabupaten' => $this->desa->kecamatan->kabupaten,
                    'provinsi' => $this->desa->kecamatan->provinsi,
                    'map_lat' => $this->map_lat,
                    'map_long' => $this->map_long,
                    'map_content' => $this->mapcontent,
                    'marker_color' => $this->marker_color,
                    'marker_type' => $this->marker_type,
                ];
                break;
            case 'wisata':
                $res = [
                    'wisata_id' => $this->id,
                    'desa_id' => $this->desa->id,
                    'kec_id' => $this->desa->kec_id,
                    'nama_wisata' => $this->nama,
                    'deskripsi_wisata' => $this->deskripsi,
                    'desa' => $this->desa->nama,
                    'kecamatan' => $this->desa->kecamatan->nama,
                    'kabupaten' => $this->desa->kecamatan->kabupaten,
                    'provinsi' => $this->desa->kecamatan->provinsi,
                    'map_lat' => $this->map_lat,
                    'map_long' => $this->map_long,
                    'map_content' => $this->mapcontent,
                    'marker_color' => $this->marker_color,
                    'marker_type' => $this->marker_type,
                ];
                break;
            default:
                $res = [];
                break;
        }
        
        return $res;

    }
}
