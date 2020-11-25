<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Desa;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Http\Resources\MapResource;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * Class DesaRepository.
 */
class DesaRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Desa::class;
    }

    public function createFromGeoJSONFeature($feature)
    {
        $kecamatans = app(KecamatanRepository::class);
        $kecamatan = $kecamatans->where('nama', '%'. $feature->properties->WADMKC .'%', 'like')->get()->first();
        if (!$kecamatan) $kecamatan = $kecamatans->create(['nama' => $feature->properties->WADMKC]);
        $data = [
            'nama' => strtoupper($feature->properties->NAMOBJ),
            'kec_id' => $kecamatan->id,
            'penduduk_total' => rand(1, 1000),
            'kabupaten' => $feature->properties->WADMKK,
            'map_bound_coordinates' => json_encode($feature->geometry->coordinates),
        ];

        $this->create($data);
    }

    public function getPaginated(Collection $data, $paged = 50, $cpage = null) : LengthAwarePaginator
    {

        // creating pagination
        $items = $data;
        $cpage = $cpage ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $result = new LengthAwarePaginator($items->forPage($cpage, $paged), $items->count(), $paged, $cpage, ['path' => route('admin.desa.index')] );

        return $result;
    }

    public function getMapDesa()
    {
        $features = $this->get()->map(function($desa) {
            return [
                'type'       => 'Feature',
                'properties' => new MapResource($desa),
                'geometry'   => [
                    'type'        => 'Polygon',
                    'coordinates' => json_decode($desa->map_bound_coordinates),
                ],
            ];
        });

        return json_encode([
            'type' =>  'FeatureCollection',
            'features' => $features
        ]);
    }

    public function getMapById($id)
    {
        $desa = $this->getById($id);
        return $desa ? json_encode([
            'type' =>  'FeatureCollection',
            'features' => [
                [
                    'type'       => 'Feature',
                    'properties' => new MapResource($desa),
                    'geometry'   => [
                        'type'        => 'Polygon',
                        'coordinates' => json_decode($desa->map_bound_coordinates),
                    ],
                ]
            ]
        ]) : '';
    }

    public function getMapByKecId($kec_id)
    {
        $features = $this->where('kec_id', $kec_id)->get()->map(function($desa) {
            return [
                'type'       => 'Feature',
                'properties' => new MapResource($desa),
                'geometry'   => [
                    'type'        => 'Polygon',
                    'coordinates' => json_decode($desa->map_bound_coordinates),
                ],
            ];
        });

        return json_encode([
            'type' =>  'FeatureCollection',
            'features' => $features
        ]);
    }
}
