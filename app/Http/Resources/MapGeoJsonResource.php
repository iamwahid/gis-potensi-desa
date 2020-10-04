<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapGeoJsonResource extends JsonResource
{
    protected $type;
    public function __construct($resource, $type = 'Point')
    {
        $this->resource = $resource;
        $this->type = $type;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' =>  'FeatureCollection',
            'features' => $request->map(function($d) {
                return [
                    'type'       => 'Feature',
                    'properties' => new MapResource($d),
                    'geometry'   => [
                        'type'        => $this->type,
                        'coordinates' => $this->type == 'Polygon' ? json_decode($d->map_bound_coordinates) : [$d->map_long, $d->map_lat],
                    ],
                ];
            })
        ];
    }
}
