@extends('backend.layouts.app')

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
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                  
              </h4>
          </div><!--col-->

          <div class="col-sm-7 pull-right">
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                <strong class="p-1 pr-3">Sortir</strong> 
                <form class="ml-auto" action="" id="form-search">
                    <div class="input-group">
                        {{ html()->select('kec_desa_id')->options([''=> 'Kecamatan/Desa'] + $kec_desa)->class('form-control')->value(request('kec_desa_id')) }}
                    </div>
                </form>
                <a href="{{ route('admin.desa.create') }}" class="btn btn-success ml-1 disabled" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
            </div><!--btn-toolbar-->
          </div><!--col-->
      </div><!--row-->

      <div class="row mt-4">
          <div class="col">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                      <tr>
                          <th>Nama</th>
                          <th>Kecamatan</th>
                          <th>Jml Penduduk</th>
                          <th>@lang('labels.general.actions')</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($desas as $d)
                          <tr>
                              <td>{{ ucwords($d->nama) }}</td>
                              <td>{{ $d->kecamatan->nama }}</td>
                              <td>{{ $d->penduduk_total }}</td>
                              <td>{!! $d->action_buttons !!}</td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
          </div><!--col-->
      </div><!--row-->
      <div class="row">
          <div class="col-7">
              <div class="float-left">
                  {!! $desas->total() !!} {{ trans_choice('labels.backend.access.roles.table.total', $desas->total()) }}
              </div>
          </div><!--col-->

          <div class="col-5">
              <div class="float-right">
                  {!! $desas->render() !!}
              </div>
          </div><!--col-->
      </div><!--row-->
  </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script>
$('.delete-item').click(function(e){
    e.preventDefault()
    let token = $('meta[name="csrf-token"]').attr('content')
    let url = $(this).attr('href')
    let data = {
        _token: token,
        _method: 'delete',
    }
    if (confirm('Yakin Menghapus ?')) {
        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function(d) {
                // console.log(d)
                alert('Terhapus')
                setTimeout(function(){
                    window.location.reload()
                }, 100)
            }
        })
    }
})

$('#kec_desa_id').on('change', function(ev) {
    window.location = '{{route("admin.desa.index")}}'+'?kec_desa_id='+$(this).val()
})
</script>
@endpush