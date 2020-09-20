<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Wisata;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Http\Resources\MapResource;
use App\Repositories\BaseRepository;

/**
 * Class WisataRepository.
 */
class WisataRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Wisata::class;
    }

    // public function createFromGeoJSONFeature(array $feature)
    // {
    //     $data = [
    //         'nama' => $feature->properties->NAMOBJ,
    //         'kecamatan' => $feature->properties->WADMKC,
    //         'kabupaten' => $feature->properties->WADMKK,
    //     ];
    // }

    public function getMapWisata()
    {
        $features = $this->get()->map(function($wisata) {
            return [
                'type'       => 'Feature',
                'properties' => new MapResource($wisata),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $wisata->map_long,
                        $wisata->map_lat,
                    ],
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
        $wisata = $this->getById($id);
        return $wisata ? json_encode([
            'type' =>  'FeatureCollection',
            'features' => [
                [
                    'type'       => 'Feature',
                    'properties' => new MapResource($wisata),
                    'geometry'   => [
                        'type'        => 'Point',
                        'coordinates' => [
                            $wisata->map_long,
                            $wisata->map_lat,
                        ],
                    ],
                ]
            ]
        ]) : '';
    }

    public function getMapByDesaId($id)
    {
        $features = $this->where('desa_id', $id)->get()->map(function($wisata) {
            return [
                'type'       => 'Feature',
                'properties' => new MapResource($wisata),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $wisata->map_long,
                        $wisata->map_lat,
                    ],
                ],
            ];
        });

        return json_encode([
            'type' =>  'FeatureCollection',
            'features' => $features
        ]);
    }
}
