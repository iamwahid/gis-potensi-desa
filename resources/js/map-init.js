var bounds = new L.LatLngBounds(new L.LatLng(-7.540849, 111.167564), new L.LatLng(-8.182266, 111.813011));
var mapurl1 = '//server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}';
var mapurl2 = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
var osm = L.tileLayer(mapurl2, {
    maxZoom: 18,
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

var baseUrl = "{{ url('/') }}";
var geojson;

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

// let available_marker = JSON.parse('{!!json_encode(config("gisdesa.value.desa.marker.available"))!!}')
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