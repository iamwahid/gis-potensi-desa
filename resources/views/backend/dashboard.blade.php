@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))
@push('after-styles')
<style>
	#form-search [value^=optbold_] {
			font-weight: bold;
			font-style: italic;
	}
			
	#form-search select option {
			font-style: italic;
	}

    .leaflet-popup-close-button {
        display:none;
    }

    .leaflet-label-overlay {
        line-height:0px;
        margin-top: 9px;
        position:absolute;
    }
</style>
@endpush
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>Peta Ponorogo</strong>
                    <div class="card-header-actions">
                        <form class="ml-auto" action="" id="form-search">
                            <div class="input-group">
                                {{ html()->select('kec_desa_id')->options([''=> 'Kecamatan/Desa'] + $kec_desa)->class('select2-single form-control') }}
                                {{ html()->select('potensi')->options([''=> 'Jenis Potensi'] + $potensi)->class('select2-single form-control') }}
                                {{ html()->text('keyword')->class('form-control') }}
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary btn-sm" id="button-search">Cari</button>
                                    <button type="button" class="btn btn-danger btn-sm" id="button-reset">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--card-header-->
                <div class="card-body">
                    <div id="mapid" style="min-height: 600px"></div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@push('after-scripts')
<script>
// base map
loadMapArea('{{ route("api.map.desa") }}')

loadMapMarker('{{ route("api.map.potency") }}')

$('#button-search').click(function(e){
	e.preventDefault()
	searchMap()
})

$('#button-reset').click(function(e){
    e.preventDefault()
    $('#kec_desa_id').val('')
    $('#potensi').val('')
	resetMap()
})

function searchMap() {
	let kec_desa_id = $('#kec_desa_id').val()
	let kec_id = kec_desa_id.split('_')[0] == 'optbold' ? kec_desa_id.split('_')[1] : null;
	let desa_id = kec_desa_id.split('_')[0] != 'optbold' ? kec_desa_id.replace('_', '') : null;
	let potensi = $('#potensi').val()

	let type = potensi.split('_')[0] == 'optbold' ? potensi.split('_')[1] : null;
	let category = potensi.split('_')[0] != 'optbold' ? potensi : null;
    let keyword = $('#keyword').val()
    
    resetMap(kec_id, desa_id, type, category, keyword)
}

function resetMap(kec_id, desa_id, type, category, keyword) {
    kec_id = kec_id || '';
    desa_id = desa_id || '';
    type = type || '';
    category = category || '';
    keyword = keyword || '';
    map.removeLayer(geojson)
    map.removeLayer(map_p_markers)
    zoomto = 'kec'
    loadMapArea('{{ route("api.map.desa") }}')
	loadMapMarker('{{ route("api.map.potency.search") }}', {kec_id, desa_id, type, category, keyword})
}

</script>
@endpush