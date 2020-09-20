<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Kecamatan;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class KecamatanRepository.
 */
class KecamatanRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Kecamatan::class;
    }

    // public function createFromGeoJSONFeature(array $feature)
    // {
    //     $data = [
    //         'nama' => $feature->properties->NAMOBJ,
    //         'kecamatan' => $feature->properties->WADMKC,
    //         'kabupaten' => $feature->properties->WADMKK,
    //     ];
    // }
}
