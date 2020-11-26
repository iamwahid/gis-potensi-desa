@extends('backend.layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                Potensi Desa <small>Tambah</small>
            </h4>
        
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col">
        <div id="mapid" style="min-height: 500px"></div>
        </div>
    </div>
    <hr>

    {{ html()->form('POST', route('admin.desa.potency.store', $desa))->acceptsFiles()->open() }}
    <div class="row mt-3">
        <div class="col">
            <label for="nama">Nama Potensi</label>
            {{ html()->text('nama')->class('form-control')->required() }}
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <label for="img">Gambar Utama</label>  <small>(Pilih gambar jika memperbarui)</small>
            {{ html()->file('image')->class('d-block')->accept('.jpg,.png,.jpeg') }}
        </div>
        <div class="col">
            <label for="img">Gallery</label>  <small>(Pilih gambar jika memperbarui)</small>
            <div class="d-flex">
                {{ html()->file('gallery1')->class('d-block')->accept('.jpg,.png,.jpeg') }}
                {{ html()->file('gallery2')->class('d-block')->accept('.jpg,.png,.jpeg') }}
                {{ html()->file('gallery3')->class('d-block')->accept('.jpg,.png,.jpeg') }}
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
              <label for="managed_by">Dikelola/Diproduksi Oleh</label>
              {{ html()->select('managed_by')
              ->options(config('gisdesa.value.desa.potency.managed_by'))->class('form-control')->required() }}
        </div>
        <div class="col">
              <label for="potency_type">Jenis Potensi</label>
              {{ html()->select('potency_type')
              ->options(config('gisdesa.value.desa.potency.potency_type'))->class('form-control')->required() }}
        </div>
    </div>

    {{-- <div class="row mt-2">
        <div class="col">
              <label for="potency_category">Kategori Potensi</label>
              {{ html()->select('potency_category')
              ->options(config('gisdesa.value.desa.potency.potency_category'))->class('form-control')->required() }}
        </div>
        <div class="col">
              <label for="potency_source">Sumber/Hasil Potensi dari</label>
              {{ html()->select('potency_source')
              ->options(config('gisdesa.value.desa.potency.potency_source'))->class('form-control')->required() }}
        </div>
    </div> --}}

    <div class="row mt-2">
        {{-- <div class="col">
            <label for="marker_color">Marker</label>
            {{ html()->select('marker_color')
            ->options($markers)->class('form-control')->required() }}
        </div> --}}
        <div class="col">
              <label for="map_lat">Latitude</label>
              {{ html()->text('map_lat')
              ->class('form-control')->required() }}
        </div>
        <div class="col">
              <label for="map_long">Longitude</label>
              {{ html()->text('map_long')
              ->class('form-control')->required() }}
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <label for="deskripsi">Deskripsi</label>
            {{ html()->textarea('deskripsi')->attribute('rows', 6)
            ->class('form-control') }}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            {{ html()->submit('Tambah')->class('btn btn-success') }}
        </div>
    </div>
      {{ html()->form()->close() }}
  </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script>
KecLabel = false;
// base map
loadMapArea('{{ route("api.map.desa.id", $desa->id) }}', function(){
    map.fitBounds(geojson.getBounds())
    marker = L.marker(geojson.getBounds().getCenter(), {icon: markers['red']}).addTo(map);
    $('#map_lat').val(marker.getLatLng().lat);
    $('#map_long').val(marker.getLatLng().lng);
}, true, true);

loadMapMarker('{{ route("api.map.desa.potency", $desa->id) }}')
ClassicEditor
    .create( document.querySelector( '#deskripsi' ) )
    .catch( error => {
        console.error( error );
    } );
</script>

<script>
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup(function(layer) {
            let nama_ = 'Nama Potensi : ' + $('#nama').val()
            let prdby_ = 'Dikelola/Diproduksi Oleh : ' + $('#managed_by').val()
            let prdty_ = 'Jenis Potensi : ' + $('#potency_type').val()
            let koor_ = "Koordinat :  " + marker.getLatLng().toString()
            return `<strong>Lokasi Baru</strong><br>${nama_}<br>${prdby_}<br>${prdty_}<br>${koor_}`
        },
        {
            direction: 'right',
            permanent: false,
            sticky: true,
            offset: [10, 0],
            opacity: 0.75
        })
        .openPopup();
        return false;
    };


    $('#marker_color').on('change', function(e){
        let color = $(this).val();
        marker.setIcon(markers[color])
    })

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#map_lat').val(latitude);
        $('#map_long').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#map_lat').val() , $('#map_long').val());
    }
    $('#map_lat').on('input', updateMarkerByInputs);
    $('#map_long').on('input', updateMarkerByInputs);
</script>
@endpush