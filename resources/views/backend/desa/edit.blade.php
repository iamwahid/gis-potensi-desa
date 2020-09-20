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
              <label for="penduduk_total">Penduduk Total</label>
              {{ html()->text('penduduk_total')->class('form-control')->required() }}
        </div>
        <div class="col">
              <label for="kk_total">KK Total</label>
              {{ html()->text('kk_total')->class('form-control')->required() }}
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