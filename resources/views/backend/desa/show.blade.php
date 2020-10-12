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
          {{-- <div class="col-12">
            <div>Kecamatan : {{$desa->kecamatan->nama}}</div>
            <div>Desa/Kelurahan : {{$desa->nama}}</div>
          </div> --}}
          <div class="col-12">
              <div id="mapid" style="min-height: 500px"></div>
          </div>
      </div>

      <div class="row mt-4">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action py-1 active show" id="p-info-desa-list" data-toggle="tab" href="#p-info-desa" role="tab" aria-controls="p-info-desa" aria-selected="false">Info Desa</a>
                <a class="list-group-item list-group-item-action py-1" id="p-jumlah-penduduk-list" data-toggle="tab" href="#p-jumlah-penduduk" role="tab" aria-controls="p-jumlah-penduduk" aria-selected="false">Jumlah Penduduk</a>
                <a class="list-group-item list-group-item-action py-1" id="p-pekerjaan-penduduk-list" data-toggle="tab" href="#p-pekerjaan-penduduk" role="tab" aria-controls="p-pekerjaan-penduduk" aria-selected="false">Pekerjaan</a>
                <a class="list-group-item list-group-item-action py-1" id="p-agama-penduduk-list" data-toggle="tab" href="#p-agama-penduduk" role="tab" aria-controls="p-agama-penduduk" aria-selected="false">Agama</a>
                <a class="list-group-item list-group-item-action py-1" id="p-pendidikan-penduduk-list" data-toggle="tab" href="#p-pendidikan-penduduk" role="tab" aria-controls="p-pendidikan-penduduk" aria-selected="false">Pendidikan</a>
                <a class="list-group-item list-group-item-action py-1" id="p-dis-penduduk-list" data-toggle="tab" href="#p-dis-penduduk" role="tab" aria-controls="p-dis-penduduk" aria-selected="false">Penduduk Disabilitas</a>
                <a class="list-group-item list-group-item-action py-1" id="p-rts-penduduk-list" data-toggle="tab" href="#p-rts-penduduk" role="tab" aria-controls="p-rts-penduduk" aria-selected="false">Rumah Tangga Sasaran</a>
            </div>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="p-info-desa" role="tabpanel" aria-labelledby="p-info-desa-list">
                    <div>Kecamatan : {{$desa->kecamatan->nama}}</div>
                    @foreach ($desa->info_desa as $k => $attr)
                        <div>{{ __('labels.desa.table.'.$k).' : '.$attr }} </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="p-jumlah-penduduk" role="tabpanel" aria-labelledby="p-jumlah-penduduk-list">
                    @foreach ($desa->jumlah_penduduk as $k => $attr)
                        <div>{{ __('labels.desa.table.'.$k).' : '.$attr }} </div>
                    @endforeach
                </div>
                <div class="tab-pane fade " id="p-pekerjaan-penduduk" role="tabpanel" aria-labelledby="p-pekerjaan-penduduk-list">
                    @foreach ($desa->pekerjaan_penduduk as $k => $attr)
                        <div>{{ __('labels.desa.table.'.$k).' : '.$attr }} </div>
                    @endforeach
                </div>
                <div class="tab-pane fade " id="p-agama-penduduk" role="tabpanel" aria-labelledby="p-agama-penduduk-list">
                    @foreach ($desa->agama_penduduk as $k => $attr)
                        <div>{{ __('labels.desa.table.'.$k).' : '.$attr }} </div>
                    @endforeach
                </div>
                <div class="tab-pane fade " id="p-pendidikan-penduduk" role="tabpanel" aria-labelledby="p-pendidikan-penduduk-list">
                    @foreach ($desa->pendidikan_penduduk as $k => $attr)
                        <div>{{ __('labels.desa.table.'.$k).' : '.$attr }} </div>
                    @endforeach
                </div>
                <div class="tab-pane fade " id="p-dis-penduduk" role="tabpanel" aria-labelledby="p-dis-penduduk-list">
                    @foreach ($desa->dis_penduduk as $k => $attr)
                        <div>{{ __('labels.desa.table.'.$k).' : '.$attr }} </div>
                    @endforeach
                </div>
                <div class="tab-pane fade " id="p-rts-penduduk" role="tabpanel" aria-labelledby="p-rts-penduduk-list">
                    @foreach ($desa->rts_penduduk as $k => $attr)
                        <div>{{ __('labels.desa.table.'.$k).' : '.$attr }} </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
  </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script>
// base map    
loadMapArea('{{ route("api.map.desa.id", $desa->id) }}', function(){
	map.fitBounds(geojson.getBounds())
}, true, true)

loadMapMarker('{{ route("api.map.desa.potency", $desa->id) }}')
</script>
@endpush