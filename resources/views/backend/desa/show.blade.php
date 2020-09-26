@extends('backend.layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                  Desa <small>Lihat</small>
              </h4>
            
					</div><!--col-->

					<div class="col-sm-7 pull-right">
            <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                <a href="{{ route('admin.desa.potency.index', $desa) }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Potensi Desa">Lihat Potensi</a>
            </div><!--btn-toolbar-->            
          </div><!--col-->
      </div><!--row-->

      <div class="row mt-4">
          <div class="col-3">
            <div>Desa : {{$desa->nama}}</div>
            <div>Kecamatan : {{$desa->kecamatan->nama}}</div>
            <div>Penduduk : {{$desa->penduduk_total}} Jiwa</div>
          </div>
          <div class="col-9">
              <div id="mapid" style="min-height: 500px"></div>
          </div>
      </div>
  </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script>
// base map    
loadMapArea('{{ route("api.map.desa.id", $desa->id) }}', function(){
	map.fitBounds(geojson.getBounds())
}, true)

loadMapMarker('{{ route("api.map.desa.potency", $desa->id) }}')
</script>
@endpush