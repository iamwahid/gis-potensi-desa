<?php

if (! function_exists('camelcase_to_word')) {

    /**
     * @param $str
     *
     * @return string
     */
    function camelcase_to_word($str)
    {
        return implode(' ', preg_split('/
          (?<=[a-z])
          (?=[A-Z])
        | (?<=[A-Z])
          (?=[A-Z][a-z])
        /x', $str));
    }
}

if (! function_exists('toGeoJSON')) {

  /**
   * @param $str
   *
   * @return string
   */
  function toGeoJSON($collection, $type = 'Point')
  {
    return json_encode([
        'type' =>  'FeatureCollection',
        'features' => $collection->map(function($d) use ($type) {
            return [
                'type'       => 'Feature',
                'properties' => new App\Http\Resources\MapResource($d),
                'geometry'   => [
                    'type'        => $type,
                    'coordinates' => $type == 'Polygon' ? json_decode($d->map_bound_coordinates) : [$d->map_long, $d->map_lat],
                ],
            ];
        })
    ]);
  }
}
