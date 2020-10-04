<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('desas', function (Blueprint $table) {
            $table->integer('penduduk_pria')->default(0);
            $table->integer('penduduk_wanita')->default(0);
            
            $table->integer('penduduk_produktif')->default(0);
            $table->integer('penduduk_work_formal')->default(0);
            $table->integer('penduduk_work_informal')->default(0);
            $table->integer('penduduk_work_none')->default(0);
            
            $table->integer('penduduk_sector_agriculture')->default(0);
            $table->integer('penduduk_sector_mining')->default(0);
            $table->integer('penduduk_sector_industry')->default(0);
            $table->integer('penduduk_sector_construction')->default(0);
            $table->integer('penduduk_sector_trade')->default(0);
            $table->integer('penduduk_sector_service')->default(0);
            $table->integer('penduduk_sector_transportation')->default(0);

            $table->integer('penduduk_edu_none')->default(0);
            $table->integer('penduduk_edu_sd')->default(0);
            $table->integer('penduduk_edu_smp')->default(0);
            $table->integer('penduduk_edu_sma')->default(0);
            $table->integer('penduduk_edu_s1')->default(0);
            $table->integer('penduduk_edu_s2')->default(0);
            $table->integer('penduduk_edu_s3')->default(0);
            
            $table->integer('penduduk_religion_islam')->default(0);
            $table->integer('penduduk_religion_protestan')->default(0);
            $table->integer('penduduk_religion_katolik')->default(0);
            $table->integer('penduduk_religion_hindu')->default(0);
            $table->integer('penduduk_religion_buddha')->default(0);
            $table->integer('penduduk_religion_lain')->default(0);

            $table->integer('penduduk_dis_blind')->default(0);
            $table->integer('penduduk_dis_deaf')->default(0);
            $table->integer('penduduk_dis_mute')->default(0);
            $table->integer('penduduk_dis_body')->default(0);
            $table->integer('penduduk_dis_mental')->default(0);

            $table->integer('penduduk_persen_kecamatan')->default(0);
            $table->integer('penduduk_padat_km2')->default(0);
            
            $table->integer('rts_raskin')->default(0);
            $table->integer('rts_jamkesmas')->default(0);
            $table->integer('rts_pkh')->default(0);
            $table->integer('rts_blsm')->default(0);

            $table->integer('letak_tinggi_kantor_desa')->default(0);
            $table->integer('luas_wilayah')->default(0);
            $table->integer('luas_persen_kecamatan')->default(0);
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
            $table->dropColumn('penduduk_pria');
            $table->dropColumn('penduduk_wanita');
            $table->dropColumn('penduduk_produktif');
            $table->dropColumn('penduduk_work_formal');
            $table->dropColumn('penduduk_work_informal');
            $table->dropColumn('penduduk_work_none');
            $table->dropColumn('penduduk_sector_agriculture');
            $table->dropColumn('penduduk_sector_mining');
            $table->dropColumn('penduduk_sector_industry');
            $table->dropColumn('penduduk_sector_construction');
            $table->dropColumn('penduduk_sector_trade');
            $table->dropColumn('penduduk_sector_service');
            $table->dropColumn('penduduk_sector_transportation');
            $table->dropColumn('penduduk_edu_none');
            $table->dropColumn('penduduk_edu_sd');
            $table->dropColumn('penduduk_edu_smp');
            $table->dropColumn('penduduk_edu_sma');
            $table->dropColumn('penduduk_edu_s1');
            $table->dropColumn('penduduk_edu_s2');
            $table->dropColumn('penduduk_edu_s3');
            $table->dropColumn('penduduk_religion_islam');
            $table->dropColumn('penduduk_religion_protestan');
            $table->dropColumn('penduduk_religion_katolik');
            $table->dropColumn('penduduk_religion_hindu');
            $table->dropColumn('penduduk_religion_buddha');
            $table->dropColumn('penduduk_religion_lain');
            $table->dropColumn('penduduk_dis_blind');
            $table->dropColumn('penduduk_dis_deaf');
            $table->dropColumn('penduduk_dis_mute');
            $table->dropColumn('penduduk_dis_body');
            $table->dropColumn('penduduk_dis_mental');
            $table->dropColumn('penduduk_persen_kecamatan');
            $table->dropColumn('penduduk_padat_km2');
            $table->dropColumn('rts_raskin');
            $table->dropColumn('rts_jamkesmas');
            $table->dropColumn('rts_pkh');
            $table->dropColumn('rts_blsm');
            $table->dropColumn('letak_tinggi_kantor_desa');
            $table->dropColumn('luas_wilayah');
            $table->dropColumn('luas_persen_kecamatan');
        });
    }
}
