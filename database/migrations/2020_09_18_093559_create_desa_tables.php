<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->bigInteger('kec_id');
            $table->integer('penduduk_total')->default(0);
            $table->string('map_lat')->nullable();
            $table->string('map_long')->nullable();
            $table->text('map_bound_coordinates')->nullable();
            $table->timestamps();
        });

        Schema::create('kecamatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->integer('penduduk_total')->default(0);
            $table->string('kabupaten')->default('Ponorogo');
            $table->string('provinsi')->default('Jawa Timur');
            $table->string('map_lat')->nullable();
            $table->string('map_long')->nullable();
            $table->text('map_bound_coordinates')->nullable();
            $table->timestamps();
        });

        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->text('deskripsi');
            $table->bigInteger('desa_id');
            $table->string('product_by')->nullable();
            $table->string('product_type');
            $table->string('map_lat')->nullable();
            $table->string('map_long')->nullable();
            $table->text('map_bound_coordinates')->nullable();
            $table->string('marker_type')->nullable();
            $table->string('marker_color')->nullable();
            $table->timestamps();
        });

        Schema::create('wisatas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->text('deskripsi');
            $table->bigInteger('desa_id');
            $table->string('manage_by')->nullable();
            $table->string('wisata_type');
            $table->string('map_lat')->nullable();
            $table->string('map_long')->nullable();
            $table->text('map_bound_coordinates')->nullable();
            $table->string('marker_type')->nullable();
            $table->string('marker_color')->nullable();
            $table->timestamps();
        });

        // DB::statement($this->dropView());
    
        // DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement($this->dropView());
        Schema::dropIfExists('desas');
        Schema::dropIfExists('kecamatans');
        Schema::dropIfExists('produks');
        Schema::dropIfExists('wisatas');
    }

    public function dropView(): string
    {
        return <<<SQL
        DROP VIEW IF EXISTS `data_wilayahs`;
        DROP VIEW IF EXISTS `data_potensi_desa`;
        SQL;
    }

    public function createView()
    {
        return <<<SQL
        CREATE VIEW `data_wilayahs` AS
        SELECT `desas`.`id` as `desa_id`, `desas`.`nama` as `nama_desa`, 
        `desas`.`penduduk_total` as `desa_penduduk_total`,
        `desas`.`map_lat` as `desa_map_lat`, `desas`.`map_long` as `desa_map_long`, `desas`.`map_bound_coordinates` as `desa_map_bound_coordinates`,
        `kecamatans`.`id` as `kec_id`, `kecamatans`.`nama` as `nama_kec`, `kecamatans`.`penduduk_total` as `kec_penduduk_total`, `kecamatans`.`map_lat` as `kec_map_lat`, `kecamatans`.`map_long` as `kec_map_long`, `kecamatans`.`map_bound_coordinates` as `kec_map_bound_coordinates`
        FROM `desas` 
        JOIN `kecamatans` ON `kecamatans`.`id` = `desas`.`kec_id`
        ORDER BY `kec_id`;

        CREATE VIEW `data_potensi_desa` AS
        SELECT `desas`.`id` as `desa_id`, `desas`.`nama` as `desa`, `kecamatans`.`nama` as `kecamatan`, `kecamatans`.`kabupaten` as `kabupaten`, `kecamatans`.`provinsi` as `provinsi`, 
        `produks`.`nama` as `desa_produk`, `produks`.`map_lat` as `produk_map_lat`, `produks`.`map_long` as `produk_map_long`,
        `wisatas`.`nama` as `desa_wisata`, `wisatas`.`map_lat` as `wisata_map_lat`, `wisatas`.`map_long` as `wisata_map_long`
        FROM `desas` 
        JOIN `kecamatans` ON `kecamatans`.`id` = `desas`.`kec_id`
        RIGHT JOIN `produks` ON `desas`.`id` = `produks`.`desa_id`
        RIGHT JOIN `wisatas` ON `desas`.`id` = `wisatas`.`desa_id`
        ORDER BY `desa_id`;
        SQL;
    }
}
