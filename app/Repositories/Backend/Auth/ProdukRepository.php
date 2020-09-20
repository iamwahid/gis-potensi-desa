<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Http\Resources\MapResource;
use App\Repositories\BaseRepository;

/**
 * Class ProdukRepository.
 */
class ProdukRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Produk::class;
    }

    // public function createFromGeoJSONFeature(array $feature)
    // {
    //     $data = [
    //         'nama' => $feature->properties->NAMOBJ,
    //         'kecamatan' => $feature->properties->WADMKC,
    //         'kabupaten' => $feature->properties->WADMKK,
    //     ];
    // }

    public function getMapProduk()
    {
        $features = $this->get()->map(function($produk) {
            return [
                'type'       => 'Feature',
                'properties' => new MapResource($produk),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $produk->map_long,
                        $produk->map_lat,
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
        $produk = $this->getById($id);
        return $produk ? json_encode([
            'type' =>  'FeatureCollection',
            'features' => [
                [
                    'type'       => 'Feature',
                    'properties' => new MapResource($produk),
                    'geometry'   => [
                        'type'        => 'Point',
                        'coordinates' => [
                            $produk->map_long,
                            $produk->map_lat,
                        ],
                    ],
                ]
            ]
        ]) : '';
    }

    public function getMapByDesaId($id)
    {
        $features = $this->where('desa_id', $id)->get()->map(function($produk) {
            return [
                'type'       => 'Feature',
                'properties' => new MapResource($produk),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $produk->map_long,
                        $produk->map_lat,
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
