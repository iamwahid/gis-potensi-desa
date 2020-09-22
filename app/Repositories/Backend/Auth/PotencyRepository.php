<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Potency;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Http\Resources\MapResource;
use App\Repositories\BaseRepository;

/**
 * Class PotencyRepository.
 */
class PotencyRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Potency::class;
    }

    // public function createFromGeoJSONFeature(array $feature)
    // {
    //     $data = [
    //         'nama' => $feature->properties->NAMOBJ,
    //         'kecamatan' => $feature->properties->WADMKC,
    //         'kabupaten' => $feature->properties->WADMKK,
    //     ];
    // }

    public function getMapPotency()
    {
        $features = $this->get()->map(function($potency) {
            return [
                'type'       => 'Feature',
                'properties' => new MapResource($potency),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $potency->map_long,
                        $potency->map_lat,
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
        $potency = $this->getById($id);
        return $potency ? json_encode([
            'type' =>  'FeatureCollection',
            'features' => [
                [
                    'type'       => 'Feature',
                    'properties' => new MapResource($potency),
                    'geometry'   => [
                        'type'        => 'Point',
                        'coordinates' => [
                            $potency->map_long,
                            $potency->map_lat,
                        ],
                    ],
                ]
            ]
        ]) : '';
    }

    public function getMapByDesaId($id)
    {
        $features = $this->where('desa_id', $id)->get()->map(function($potency) {
            return [
                'type'       => 'Feature',
                'properties' => new MapResource($potency),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $potency->map_long,
                        $potency->map_lat,
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
