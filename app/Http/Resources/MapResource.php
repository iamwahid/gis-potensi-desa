<?php

namespace App\Http\Resources;

use App\Models\Desa;
use App\Models\Potency;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    protected $type;
    public function __construct($resource)
    {
        $this->resource = $resource;

        if ($resource instanceof Desa) $this->type = 'desa';
        else if ($resource instanceof Potency) $this->type = 'potensi';
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
            case 'potensi':
                $res = [
                    'potensi_id' => $this->id,
                    'desa_id' => $this->desa->id,
                    'kec_id' => $this->desa->kec_id,
                    'nama_potensi' => $this->nama,
                    'deskripsi_potensi' => $this->deskripsi,
                    'managed_by' => $this->managed_by,
                    'potency_type' => $this->potency_type,
                    'potency_category' => $this->potency_category,
                    'potency_source' => $this->potency_source,
                    'is_draft' => $this->is_draft,
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
