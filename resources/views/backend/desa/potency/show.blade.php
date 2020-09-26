@extends('backend.layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                  Potensi Desa <small>Lihat</small>
              </h4>
            
          </div><!--col-->
      </div><!--row-->

      <div class="row mt-4">
          <div class="col-3">
            <div>Nama Potensi Desa : {{$potency->nama}}</div>
            <div>Dikelola/Diproduksi Oleh : {{$potency->managed_by}}</div>
            <div>Jenis Potensi : {{$potency->potency_type}}</div>
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
loadMapArea('{{ route("api.map.desa.id", $potency->desa->id) }}', function(){
	map.fitBounds(geojson.getBounds())
}, true)    
loadMapMarker('{{ route("api.map.potency.id", $potency->id) }}')
</script>
@endpush