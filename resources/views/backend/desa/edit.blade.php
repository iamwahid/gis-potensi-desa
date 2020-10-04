@extends('backend.layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                  Desa <small>Edit</small>
              </h4>
            
          </div><!--col-->
      </div><!--row-->

    {{ html()->modelForm($desa, 'POST', route('admin.desa.update', $desa))->open() }}
    <div class="row mt-4">
        <div class="col">
            <label for="nama">Desa</label>
            {{ html()->text('nama')->class('form-control')->required() }}
        </div>
        <div class="col">
            <label for="kec_id">Kecamatan</label>
            {{ html()->select('kec_id')
            ->options($kecamatans)->class('form-control')->required() }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_pria">@lang('labels.desa.table.penduduk_pria')</label>
              {{ html()->text('penduduk_pria')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_wanita">@lang('labels.desa.table.penduduk_wanita')</label>
              {{ html()->text('penduduk_wanita')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_total">@lang('labels.desa.table.penduduk_total')</label>
              {{ html()->text('penduduk_total')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_produktif">@lang('labels.desa.table.penduduk_produktif')</label>
              {{ html()->text('penduduk_total')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_persen_kecamatan">@lang('labels.desa.table.penduduk_persen_kecamatan')</label>
              {{ html()->text('penduduk_persen_kecamatan')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_padat_km2">@lang('labels.desa.table.penduduk_padat_km2')</label>
              {{ html()->text('penduduk_padat_km2')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
              <label for="letak_tinggi_kantor_desa">@lang('labels.desa.table.letak_tinggi_kantor_desa')</label>
              {{ html()->text('letak_tinggi_kantor_desa')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="luas_wilayah">@lang('labels.desa.table.luas_wilayah')</label>
              {{ html()->text('luas_wilayah')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="luas_persen_kecamatan">@lang('labels.desa.table.luas_persen_kecamatan')</label>
              {{ html()->text('luas_persen_kecamatan')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <hr>
    <h4 class="mt-3">Pekerjaan Penduduk</h4>
    <div class="row mt-2">
        
        <div class="col">
              <label for="penduduk_work_formal">@lang('labels.desa.table.penduduk_work_formal')</label>
              {{ html()->text('penduduk_work_formal')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_work_informal">@lang('labels.desa.table.penduduk_work_informal')</label>
              {{ html()->text('penduduk_work_informal')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_work_none">@lang('labels.desa.table.penduduk_work_none')</label>
              {{ html()->text('penduduk_work_none')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <hr>
    <h4 class="mt-3">Bidang Pekerjaan</h4>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_sector_agriculture">@lang('labels.desa.table.penduduk_sector_agriculture')</label>
              {{ html()->text('penduduk_sector_agriculture')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_sector_mining">@lang('labels.desa.table.penduduk_sector_mining')</label>
              {{ html()->text('penduduk_sector_mining')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_sector_industry">@lang('labels.desa.table.penduduk_sector_industry')</label>
              {{ html()->text('penduduk_sector_industry')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_sector_trade">@lang('labels.desa.table.penduduk_sector_trade')</label>
              {{ html()->text('penduduk_sector_trade')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_sector_service">@lang('labels.desa.table.penduduk_sector_service')</label>
              {{ html()->text('penduduk_sector_service')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_sector_transportation">@lang('labels.desa.table.penduduk_sector_transportation')</label>
              {{ html()->text('penduduk_sector_transportation')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <hr>
    <h4 class="mt-3">Pendidikan Penduduk</h4>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_edu_none">@lang('labels.desa.table.penduduk_edu_none')</label>
              {{ html()->text('penduduk_edu_none')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_edu_sd">@lang('labels.desa.table.penduduk_edu_sd')</label>
              {{ html()->text('penduduk_edu_sd')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_edu_smp">@lang('labels.desa.table.penduduk_edu_smp')</label>
              {{ html()->text('penduduk_edu_smp')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_edu_sma">@lang('labels.desa.table.penduduk_edu_sma')</label>
              {{ html()->text('penduduk_edu_sma')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_edu_s1">@lang('labels.desa.table.penduduk_edu_s1')</label>
              {{ html()->text('penduduk_edu_s1')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_edu_s2">@lang('labels.desa.table.penduduk_edu_s2')</label>
              {{ html()->text('penduduk_edu_s2')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_edu_s3">@lang('labels.desa.table.penduduk_edu_s3')</label>
              {{ html()->text('penduduk_edu_s3')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <hr>
    <h4 class="mt-3">Agama Penduduk</h4>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_religion_islam">@lang('labels.desa.table.penduduk_religion_islam')</label>
              {{ html()->text('penduduk_religion_islam')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_religion_protestan">@lang('labels.desa.table.penduduk_religion_protestan')</label>
              {{ html()->text('penduduk_religion_protestan')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_religion_katolik">@lang('labels.desa.table.penduduk_religion_katolik')</label>
              {{ html()->text('penduduk_religion_katolik')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_religion_hindu">@lang('labels.desa.table.penduduk_religion_islam')</label>
              {{ html()->text('penduduk_religion_hindu')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_religion_buddha">@lang('labels.desa.table.penduduk_religion_protestan')</label>
              {{ html()->text('penduduk_religion_buddha')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_religion_lain">@lang('labels.desa.table.penduduk_religion_katolik')</label>
              {{ html()->text('penduduk_religion_lain')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <hr>
    <h4 class="mt-3">Penduduk Disabilitas</h4>
    <div class="row mt-2">
        <div class="col">
              <label for="penduduk_dis_blind">@lang('labels.desa.table.penduduk_dis_blind')</label>
              {{ html()->text('penduduk_dis_blind')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_dis_deaf">@lang('labels.desa.table.penduduk_dis_deaf')</label>
              {{ html()->text('penduduk_dis_deaf')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_dis_mute">@lang('labels.desa.table.penduduk_dis_mute')</label>
              {{ html()->text('penduduk_dis_mute')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_dis_body">@lang('labels.desa.table.penduduk_dis_body')</label>
              {{ html()->text('penduduk_dis_body')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="penduduk_dis_mental">@lang('labels.desa.table.penduduk_dis_mental')</label>
              {{ html()->text('penduduk_dis_mental')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>
    <hr>
    <h4 class="mt-3">Rumah Tangga Sasaran</h4>
    <div class="row mt-2">
        <div class="col">
              <label for="rts_raskin">@lang('labels.desa.table.rts_raskin')</label>
              {{ html()->text('rts_raskin')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="rts_jamkesmas">@lang('labels.desa.table.rts_jamkesmas')</label>
              {{ html()->text('rts_jamkesmas')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="rts_pkh">@lang('labels.desa.table.rts_pkh')</label>
              {{ html()->text('rts_pkh')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
        <div class="col">
              <label for="rts_blsm">@lang('labels.desa.table.rts_blsm')</label>
              {{ html()->text('rts_blsm')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            {{ html()->submit('Simpan')->class('btn btn-success') }}
        </div>
    </div>
    {{ html()->form()->close() }}
  </div><!--card-body-->
</div><!--card-->
@endsection