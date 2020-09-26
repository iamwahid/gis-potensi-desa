@extends('frontend.layouts.map')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@push('after-styles')
<style>
	#form-search [value^=optbold_] {
			font-weight: bold;
			font-style: italic;
	}
			
	#form-search select option {
			font-style: italic;
	}
</style>
@endpush

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<div class="d-flex">
						<div class="py-1"><i class="fas fa-map-marked-alt"></i> Peta Ponorogo</div>
						<form class="ml-auto" action="" id="form-search">
							<strong>Pencarian Potensi</strong> 
							<div class="input-group">
								{{ html()->select('kec_desa_id')->options([''=> 'Kecamatan/Desa'] + $kec_desa)->class('form-control form-control-sm') }}
								{{ html()->select('potensi')->options([''=> 'Jenis Potensi'] + $potensi)->class('form-control form-control-sm') }}
								{{ html()->text('keyword')->class('form-control form-control-sm') }}
								<div class="input-group-append">
									<button type="submit" class="btn btn-primary btn-sm" id="button-search">Cari</button>
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

