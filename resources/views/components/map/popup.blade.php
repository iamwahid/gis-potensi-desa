<div class="d-flex flex-row">
  <div class="p-1">
    <img src="{{ $image ?: 'http://placehold.it/100x100?text=image'}}" alt="" style="max-width: 100px; max-height:100px">
  </div>
  <div class="p-1">
    @foreach ($props as $p)
    <div class="d-block">{!!$p!!}</div>
    @endforeach
  </div>
</div>
<div class="d-flex flex-column">
  <div class="p-1">
    @foreach ($links as $l => $v)
    <a href="{{$l}}">{{$v}}</a>
    @endforeach
  </div>
</div>

