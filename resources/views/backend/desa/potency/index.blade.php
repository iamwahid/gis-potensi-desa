@extends('backend.layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                  Potensi Desa
              </h4>
          </div><!--col-->

          <div class="col-sm-7 pull-right">
            <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                <a href="{{ route('admin.desa.potency.create', $desa) }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
            </div><!--btn-toolbar--> 
          </div><!--col-->
      </div><!--row-->

      <div class="row mt-4">
          <div class="col">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                      <tr>
                          <th>Nama Potensi</th>
                          <th>Dikelola/Diproduksi Oleh</th>
                          <th>Jenis Potensi</th>
                          <th>Verifikator</th>
                          <th>@lang('labels.general.actions')</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($potencies as $d)
                          <tr>
                              <td>{!! ucwords($d->nama).' '.$d->verified_label !!}</td>
                              <td>{{ ucwords($d->managed_by) }}</td>
                              <td>{{ ucwords($d->potency_type) }}</td>
                              <td>{{ ucwords($d->verifier_name) }}</td>
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
                  {{-- {!! $potencies->total() !!} {{ trans_choice('labels.backend.access.roles.table.total', $potencies->total()) }} --}}
              </div>
          </div><!--col-->

          <div class="col-5">
              <div class="float-right">
                  {{-- {!! $potencies->render() !!} --}}
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
</script>
@endpush