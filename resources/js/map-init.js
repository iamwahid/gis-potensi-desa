var bounds = new L.LatLngBounds(new L.LatLng(-7.540849, 111.167564), new L.LatLng(-8.182266, 111.813011));
var mapurl1 = '//server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}';
var mapurl2 = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
var osm = L.tileLayer(mapurl2, {
    maxZoom: 18,
    minZoom: 10,
    attribution: '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});
var map = new L.Map('mapid', {
    center: bounds.getCenter(),
    latlng: ['-7.866688', '111.466614'],
    zoom: 10,
    layers: [osm],
    maxBounds: bounds,
    maxBoundsViscosity: 1.0
});
var geojson;
var map_p_markers;

var greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

var goldIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

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
    if (zoomto == 'kec') {
        map.removeLayer(geojson)
        map.removeLayer(map_p_markers)
        zoomto = 'desa'
        loadMapArea(baseUrl+'/api/map/kec/'+e.target.feature.properties.kec_id, function(){
            map.fitBounds(geojson.getBounds())
        }, false, false)
    } else {
        map.fitBounds(e.target.getBounds());
    }
}

function onEachFeature(feature, layer) {
    layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature,
            dblclick: function(e) {
                console.log('dbl click')
            }
    });
}

function awMarker(icon, markerColor) {
    return L.divIcon({
        className: 'custom-div-icon',
        html: `<div style='background-color: ${markerColor} !important;' class='marker-pin'></div><i class='fa fa-${icon} awesome text-white'></i>`,
        iconSize: [35, 45],
        iconAnchor: [17, 42],
        popupAnchor: [-10, -26],
        shadowAnchor: [10, 12]
    });
}

let markers = {};
for (const key in available_marker) {
    if (available_marker.hasOwnProperty(key)) {
        const el = available_marker[key];
        markers[key] = awMarker(el, key)
    }
}

// Bound line
// var latlngs = L.rectangle(bounds).getLatLngs();
// L.polyline(latlngs[0].concat(latlngs[0][0])).addTo(map);
var kecColors = [
    '#85B569',
    '#23D37C',
    '#73B1F7',
    '#644C9D',
    '#2F066E',
    '#9E77D0',
    '#26F0CD',
    '#973C84',
    '#F09518',
    '#FDB2C2',
    '#40B014',
    '#888C18',
    '#B7B638',
    '#995C9D',
    '#9C4882',
    '#79A8BA',
    '#A16EDC',
    '#2B2588',
    '#BCB9DC',
    '#B2FA9C',
]

function kecColor(kec_id) {
    return kecColors[kec_id-1];
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getColor(d) {
    return d > 1000 ? '#800026' :
        d > 500  ? '#BD0026' :
        d > 200  ? '#E31A1C' :
        d > 100  ? '#FC4E2A' :
        d > 50   ? '#FD8D3C' :
        d > 20   ? '#FEB24C' :
        d > 10   ? '#FED976' :
                    '#16990D';
}

function loadMapArea(url, callback, disableEachFeature, disablePopup) {
	callback = callback || function(){};
    disableEachFeature = disableEachFeature || false;
    disableEachFeature = disableEachFeature || false;
	axios.get(url)
		.then(function (response) {
			geojson = L.geoJSON(response.data, {
				style: function(geoJsonPoint) {
                    let clr;
                    if (zoomto == 'kec') clr = kecColor(geoJsonPoint.properties.kec_id);
                    else clr = getColor(geoJsonPoint.properties.penduduk_total);
                    return {
                        color: clr, 
                        "weight": 0.5, 
                        "opacity": 1};
				},
				onEachFeature: disableEachFeature ? function(){} : onEachFeature
			});
            
            if (!disablePopup) {
                geojson = geojson.bindPopup(function (layer) {
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
            }
            
			geojson.addTo(map);

			callback()
		})
		.catch(function (error) {
			console.log(error);
		});
}

function loadMapMarker(url, params, callback) {
	params = params || {};
	callback = callback || function(){};
	axios.get(url, {
		params:params
	})
	.then(function (response) {
		map_p_markers = L.geoJSON(response.data, {
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

		callback()
	})
	.catch(function (error) {
		console.log(error);
	});
}
