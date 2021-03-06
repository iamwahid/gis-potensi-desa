@extends('backend.layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <div class="row mb-3">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                  Desa <small>Edit</small>
              </h4>
            
          </div><!--col-->
      </div><!--row-->

    {{ html()->modelForm($desa, 'POST', route('admin.desa.update', $desa))->acceptsFiles()->open() }}
    <ul class="nav nav-pills mb-1"" role="tablist">
      <li class="nav-item">
          <a class="nav-link active show" data-toggle="tab" href="#tab-info-desa" role="tab" aria-controls="tab-info-desa" aria-selected="false">
               Info Desa
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tab-penduduk" role="tab" aria-controls="tab-penduduk" aria-selected="false">
               Jumlah Penduduk
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tab-pekerjaan" role="tab" aria-controls="tab-pekerjaan" aria-selected="false">
               Pekerjaan
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tab-agama" role="tab" aria-controls="tab-agama" aria-selected="false">
               Agama
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tab-pendidikan" role="tab" aria-controls="tab-pendidikan" aria-selected="false">
               Pendidikan
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tab-difabel" role="tab" aria-controls="tab-difabel" aria-selected="false">
               Penduduk Disabilitas
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tab-rts" role="tab" aria-controls="tab-rts" aria-selected="false">
               Rumah Tangga Sasaran
          </a>
      </li>
    </ul>
    <div class="tab-content">
          <div class="tab-pane active show" id="tab-info-desa" role="tabpanel">
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
                  {{-- <div class="col">
                      <label for="img">Gambar</label><small>Pilih gambar jika memperbarui</small>
                      {{ html()->file('image')->class('d-block')->accept('.jpg,.png,.jpeg') }}
                  </div> --}}
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
              </div>
              <div class="row mt-2">
                  <div class="col">
                        <label for="luas_persen_kecamatan">@lang('labels.desa.table.luas_persen_kecamatan')</label>
                        {{ html()->text('luas_persen_kecamatan')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
              </div>
          </div>
          <div class="tab-pane" id="tab-penduduk" role="tabpanel">
            <div class="row mt-2">
                  <div class="col">
                        <label for="penduduk_pria">@lang('labels.desa.table.penduduk_pria')</label>
                        {{ html()->text('penduduk_pria')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
                  <div class="col">
                        <label for="penduduk_wanita">@lang('labels.desa.table.penduduk_wanita')</label>
                        {{ html()->text('penduduk_wanita')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
            </div>
            <div class="row mt-2">
                  <div class="col">
                        <label for="penduduk_total">@lang('labels.desa.table.penduduk_total')</label>
                        {{ html()->text('penduduk_total')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
                  <div class="col">
                        <label for="penduduk_produktif">@lang('labels.desa.table.penduduk_produktif')</label>
                        {{ html()->text('penduduk_produktif')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
              </div>
          </div>
          <div class="tab-pane" id="tab-pekerjaan" role="tabpanel">
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
                      <label for="penduduk_sector_construction">@lang('labels.desa.table.penduduk_sector_construction')</label>
                      {{ html()->text('penduduk_sector_construction')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
                  <div class="col">
                        <label for="penduduk_sector_trade">@lang('labels.desa.table.penduduk_sector_trade')</label>
                        {{ html()->text('penduduk_sector_trade')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
                  <div class="col">
                        <label for="penduduk_sector_service">@lang('labels.desa.table.penduduk_sector_service')</label>
                        {{ html()->text('penduduk_sector_service')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
              </div>
              <div class="row mt-2">
                  <div class="col">
                        <label for="penduduk_sector_transportation">@lang('labels.desa.table.penduduk_sector_transportation')</label>
                        {{ html()->text('penduduk_sector_transportation')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
                  <div class="col">
                      <label for="penduduk_sector_tni_polri">@lang('labels.desa.table.penduduk_sector_tni_polri')</label>
                      {{ html()->text('penduduk_sector_tni_polri')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
                  <div class="col">
                      <label for="penduduk_sector_asn">@lang('labels.desa.table.penduduk_sector_asn')</label>
                      {{ html()->text('penduduk_sector_asn')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
              </div>
          </div>
          <div class="tab-pane" id="tab-pendidikan" role="tabpanel">
            <div class="row mt-2">
                  <div class="col">
                        <label for="penduduk_edu_none">@lang('labels.desa.table.penduduk_edu_none')</label>
                        {{ html()->text('penduduk_edu_none')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
                  <div class="col">
                        <label for="penduduk_edu_sd">@lang('labels.desa.table.penduduk_edu_sd')</label>
                        {{ html()->text('penduduk_edu_sd')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
            </div>
            <div class="row mt-2">
                  <div class="col">
                        <label for="penduduk_edu_smp">@lang('labels.desa.table.penduduk_edu_smp')</label>
                        {{ html()->text('penduduk_edu_smp')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
                  <div class="col">
                        <label for="penduduk_edu_sma">@lang('labels.desa.table.penduduk_edu_sma')</label>
                        {{ html()->text('penduduk_edu_sma')->class('form-control')->attribute('min', 0)->attribute('type', 'number')->required() }}
                  </div>
            </div>
            <div class="row mt-2">
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
          </div>
          <div class="tab-pane" id="tab-agama" role="tabpanel">
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
          </div>
          <div class="tab-pane" id="tab-difabel" role="tabpanel">
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
          </div>
          <div class="tab-pane" id="tab-rts" role="tabpanel">
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