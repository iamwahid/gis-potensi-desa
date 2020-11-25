<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBidangDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('desas', function (Blueprint $table) {
            $table->integer('penduduk_sector_tni_polri')->default(0)->after('penduduk_sector_transportation');
            $table->integer('penduduk_sector_asn')->default(0)->after('penduduk_sector_tni_polri');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('desas', function (Blueprint $table) {
            $table->dropColumn(['penduduk_sector_tni_polri', 'penduduk_sector_asn']);
        });
    }
}
