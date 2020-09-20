<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map_desa:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Map Desa from JSON';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $desas = app('App\Repositories\Backend\Auth\DesaRepository');
        $var = json_decode(file_get_contents('file:///D:/Proyek/desa-gis/rd/convert_dup.json'));
        foreach ($var->features as $k => $v) {
            if (strtolower($v->properties->WADMKK) != 'ponorogo') continue;
            $desas->createFromGeoJSONFeature($v);
        }
    }
}
