@extends('layouts.app')
@section('static', 'statick-side')
@section('content') 
@include('layouts.sidebar', ['hide'=>'0'])
<div class="container-fluid px-5"> 
  @foreach(App\Modulo::get() as $mod)
  <div class="my-4">
    @if(Auth::user()->tieneModulo($mod->id))
        <h4>
          @if($mod->icon)
          <i class="{{$mod->icon}}"></i>
          @else
          <i class="fab fa-ethereum"></i>
          @endif
          <span>{{$mod->nombre}}</span>
        </h4>
        <div class="row">
        @foreach($mod->programs as $prog)
          @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && !$prog->sub_modulo_id)
          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 p-3">
            <a href="{{route($prog->route)}}">
              <div class="card">
                <div class="card-body text-center">
                  <h5 class="card-title"><i class="{{$prog->icon}}"></i></h5>           
                  {{$prog->nombre}}
                </div>
              </div> 
            </a>         
          </div>
          @endif
        @endforeach 
        </div>
        @foreach($mod->submodulos as $submod)
        @if(Auth::user()->tieneSubModulo($submod->id))
          <div class="row col my-2">
            <h5>
              <span>{{$submod->nombre}}</span>
            </h5>
          </div>
          <div class="row ">
            @foreach($submod->programs as $prog)
              @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && $prog->sub_modulo_id)
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 p-3">
                  <a href="{{route($prog->route)}}">
                    <div class="card" style="height:100%;">
                      <div class="card-body text-center">
                        <h5 class="card-title"><i class="{{$prog->icon}}"></i></h5>   
                        {{$prog->nombre}}        
                      </div>                        
                    </div>
                  </a>         
                </div>
              @endif
            @endforeach 
          </div>
        @endif
        @endforeach                                                
    @endif
  </div>
  @endforeach
  </div>
</div>
@endsection
@section('mis_scripts')
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
@endsection