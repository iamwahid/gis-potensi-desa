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
	// Bound line
	// var latlngs = L.rectangle(bounds).getLatLngs();
	// L.polyline(latlngs[0].concat(latlngs[0][0])).addTo(map);

	// base map
	axios.get('{{ route("api.map.desa.id", $desa->id) }}')
	.then(function (response) {
		geojson = L.geoJSON(response.data, {
			style: function(geoJsonPoint) {
					console.log(geoJsonPoint.properties.penduduk_total);
					return {color: getColor(geoJsonPoint.properties.penduduk_total), "weight": 1, "opacity": 0.65};
			},
		})
		.bindPopup(function (layer) {
			return layer.feature.properties.map_content;
		},
		{
			direction: 'right',
			permanent: false,
			sticky: true,
			offset: [10, 0],
			opacity: 0.75,
			className: 'leaflet-c-popup'
        })
        .addTo(map);
        
        map.fitBounds(geojson.getBounds())
		
	})
	.catch(function (error) {
		console.log(error);
    });
    

	axios.get('{{ route("api.map.desa.potency", $desa->id) }}')
	.then(function (response) {
		L.geoJSON(response.data, {
			pointToLayer: function(geoJsonPoint, latlng) {
						return L.marker(latlng, {icon: markers[geoJsonPoint.properties.marker_color]});
				}
		})
		.bindPopup(function(layer){
			return layer.feature.properties.map_content;
		}, 
		{
			direction: 'right',
			permanent: false,
			sticky: true,
			offset: [10, 0],
			opacity: 0.75,
			className: 'leaflet-c-popup'
		})
		.addTo(map);
	})
	.catch(function (error) {
		console.log(error);
	});

</script>
@endpush