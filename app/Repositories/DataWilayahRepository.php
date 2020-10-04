<?php

namespace App\Repositories;

use App\Models\DataWilayah;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Http\Resources\MapResource;
use App\Repositories\BaseRepository;

/**
 * Class DataWilayahRepository.
 */
class DataWilayahRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return DataWilayah::class;
    }

}
