@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>Peta Ponorogo</strong>
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

function searchMap() {
	let kec_desa_id = $('#kec_desa_id').val()
	let kec_id = kec_desa_id.split('_')[0] == 'optbold' ? kec_desa_id.split('_')[1] : null;
	let desa_id = kec_desa_id.split('_')[0] != 'optbold' ? kec_desa_id.replace('_', '') : null;
	let potensi = $('#potensi').val()

	let type = potensi.split('_')[0] == 'optbold' ? potensi.split('_')[1] : null;
	let category = potensi.split('_')[0] != 'optbold' ? potensi : null;
	let keyword = $('#keyword').val()
	map.removeLayer(map_p_markers)
	loadMapMarker('{{ route("api.map.potency.search") }}', {kec_id, desa_id, type, category, keyword})
}

</script>
@endpush