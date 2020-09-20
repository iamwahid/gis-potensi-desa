@extends('backend.layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                  Produk Desa <small>Lihat</small>
              </h4>
            
          </div><!--col-->
      </div><!--row-->

      <div class="row mt-4">
          <div class="col-3">
            <div>Produk Desa : {{$produk->nama}}</div>
            <div>Produksi Oleh : {{$produk->product_by}}</div>
            <div>Jenis Produk : {{$produk->product_type}}</div>
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
	axios.get('{{ route("api.map.desa.id", $produk->desa->id) }}')
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
    

	axios.get('{{ route("api.map.produk.id", $produk->id) }}')
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