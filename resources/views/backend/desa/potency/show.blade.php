@extends('backend.layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                  Potensi Desa <small>Lihat</small> {!! $potency->verified_label !!}
              </h4>
            
          </div><!--col-->
      </div><!--row-->

      <div class="row mt-4">
          <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col text-center">
                            @if ($potency->image)
                            <img src="{{asset('storage'.$potency->image)}}" alt="" class="img-fluid" style="max-height: 200px">
                            @else
                            <img src="http://placehold.it/100x100?text=image" alt="img-fluid" style="max-height: 200px">
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            @if ($potency->galleries && $potency->galleries->gallery1)
                            <button type="button" class="btn p-0" data-toggle="modal" data-target="#img-modal"><img src="{{asset('storage'.$potency->galleries->gallery1)}}" alt="" class="img-fluid"></button>
                            @endif
                        </div>
                        <div class="col px-0">
                            @if ($potency->galleries && $potency->galleries->gallery2)
                            <button type="button" class="btn p-0" data-toggle="modal" data-target="#img-modal"><img src="{{asset('storage'.$potency->galleries->gallery2)}}" alt="" class="img-fluid"></button>
                            @endif
                        </div>
                        <div class="col">
                            @if ($potency->galleries && $potency->galleries->gallery3)
                            <button type="button" class="btn p-0" data-toggle="modal" data-target="#img-modal"><img src="{{asset('storage'.$potency->galleries->gallery3)}}" alt="" class="img-fluid"></button>
                            @endif
                        </div>
                    </div>
                    <div id="img-modal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img class="img-fluid" id="img-modal-content">
                                </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
              <table>
                  <tr>
                      <td><strong>Jenis Potensi</strong></td>
                      <td>:</td>
                      <td>{{$potency->potency_type}}</td>
                  </tr>
                  <tr>
                      <td><strong>Nama Potensi Desa</strong></td>
                      <td>:</td>
                      <td>{{$potency->nama}}</td>
                  </tr>
                  <tr>
                      <td><strong>Dikelola/Diproduksi Oleh</strong></td>
                      <td>:</td>
                      <td>{{$potency->managed_by}}</td>
                  </tr>
              </table>
              
          </div>
          <div class="col-9">
              <div id="mapid" style="min-height: 500px"></div>
          </div>
      </div>
      <div class="row">
          <div class="col text-justify">
            <hr>
            <p>{!!$potency->deskripsi!!}</p>
          </div>
      </div>
  </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script>
// base map
KecLabel = false;

loadMapArea('{{ route("api.map.desa.id", $potency->desa->id) }}', function(){
	map.fitBounds(geojson.getBounds())
}, true)    
loadMapMarker('{{ route("api.map.potency.id", $potency->id) }}')

$('[data-toggle="modal"').click(function(e){
    $('#img-modal-content').attr('src', $(this).find('img').attr('src'))
})
</script>
@endpush