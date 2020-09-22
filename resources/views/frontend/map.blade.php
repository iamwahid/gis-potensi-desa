@extends('frontend.layouts.map')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<div class="d-flex">
						<div class="py-1"><i class="fas fa-map-marked-alt"></i> Peta Ponorogo</div>
						<form class="ml-auto" action="">
							<div class="input-group">
								<input type="text" name="cari" class="form-control form-control-sm" required="" maxlength="10" placeholder="Cari nama desa..." aria-describedby="button-addon2">
								<div class="input-group-append">
									<button type="submit" class="btn btn-primary btn-sm" id="button-addon2">Cari</button>
								</div>
							</div>
						</form>
					</div>					
				</div>
				<div class="card-body">
					<div id="mapid" style="min-height: 600px"></div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('after-scripts')
<script>
	// Bound line
	// var latlngs = L.rectangle(bounds).getLatLngs();
	// L.polyline(latlngs[0].concat(latlngs[0][0])).addTo(map);

	var zoomto = 'kec';
	var info = L.control();

	info.onAdd = function (map) {
			this._div = L.DomUtil.create('div', 'leaflet-side-info'); // create a div with a class "info"
			this.update();
			return this._div;
	};

	// method that we will use to update the control based on feature properties passed
	info.update = function (props) {
			this._div.innerHTML = '<h4>Informasi Peta</h4>' +  (props ?
					`<b> Wilayah ${props.provinsi} </b><br>
					Kab. ${props.kabupaten} <br>
					Kec. ${props.kecamatan} <br>
					${props.desa} <br>
					`
					: 'tunjuk daerah');
	};

	info.addTo(map);

	function highlightFeature(e) {
		var layer = e.target;

		layer.setStyle({
				weight: 5,
				color: '#666',
				dashArray: '',
				fillOpacity: 0.4
		});

		if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
				layer.bringToFront();
		}
		info.update(layer.feature.properties);
	}

	function resetHighlight(e) {
		geojson.resetStyle(e.target);
		info.update();
	}
	function zoomToFeature(e) {
		console.log(e)
		if (zoomto == 'kec') {
			map.removeLayer(geojson)
			axios.get(baseUrl+'/api/map/kec/'+e.target.feature.properties.kec_id)
			.then(function (response) {
				geojson = L.geoJSON(response.data, {
					style: function(geoJsonPoint) {
							return {color: getColor(geoJsonPoint.properties.penduduk_total), "weight": 1, "opacity": 0.65};
					},
					onEachFeature: onEachFeature
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
				zoomto = 'desa'
			})
			.catch(function (error) {
				console.log(error);
			});
		} else map.fitBounds(e.target.getBounds());
	}

	function onEachFeature(feature, layer) {
		layer.on({
				mouseover: highlightFeature,
				mouseout: resetHighlight,
				click: zoomToFeature,
		});
	}

	// base map
	axios.get('{{ route("api.map.desa") }}')
	.then(function (response) {
		geojson = L.geoJSON(response.data, {
			style: function(geoJsonPoint) {
					return {color: getColor(geoJsonPoint.properties.penduduk_total), "weight": 1, "opacity": 0.65};
			},
			onEachFeature: onEachFeature
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
		
	})
	.catch(function (error) {
		console.log(error);
	});

	axios.get('{{ route("api.map.produk") }}')
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

	axios.get('{{ route("api.map.wisata") }}')
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

