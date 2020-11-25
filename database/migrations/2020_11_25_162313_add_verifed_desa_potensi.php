<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifedDesaPotensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('desas', function (Blueprint $table) {
            $table->boolean('verified')->default(false)->after('luas_persen_kecamatan');
            $table->integer('verified_by')->nullable()->after('verified');
        });
        Schema::table('potencies', function (Blueprint $table) {
            $table->boolean('verified')->default(false)->after('marker_color');
            $table->integer('verified_by')->nullable()->after('verified');
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
            $table->dropColumn(['verified', 'verified_by']);
        });
        Schema::table('potencies', function (Blueprint $table) {
            $table->dropColumn(['verified', 'verified_by']);
        });
    }
}
