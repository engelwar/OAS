@extends('layouts.app')
@section('estilo')
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0'])
<div class="wrapper">
  <div class="row d-flex justify-content-center p-4 w-100">
    <div class="container border rounded w-100 bg-light pt-4">
      <div class="row p-2">
        <div class="col-12">
          <h3>FORMULARIOS DE PERMISOS</h3>
        </div>
      </div>
      <div class="d-flex pb-4 justify-content-between">
        <div class="">
          <form class="form-inline" action="{{action('LicenciaController@index')}}" method="GET">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="" class="mr-2">Buscar por estado</label>
              </div>
              <div class="col-auto">
                <select class="form-control mr-sm-2 col-5 col-sm-auto" id="buscar" name="estado">
                  <option value="">Todos</option>
                  <option value="Aceptada">Aceptados</option>
                  <option value="Rechazada">Rechazados</option>
                  <option value="null">Sin asignar</option>
                </select>
              </div>
              <div class="col-auto">
                <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
              </div>
            </div>
          </form>
        </div>
        @if (Auth::user()->tienePermiso(18,4))
        <div class="">
          <form class="form-inline" action="{{action('LicenciaController@index')}}" method="GET">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <select class="form-control mr-sm-2 col-5 col-sm-auto" id="buscar" name="buscar">
                  <option value="1">Nombre</option>
                  <option value="2">CI</option>
                </select>
              </div>
              <div class="col-auto">
                <input id="dato" name="dato" class="form-control col-4 col-sm-auto ml-auto" type="search" placeholder="Buscar" aria-label="Search">
              </div>
              <div class="col-auto">
                <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
              </div>
            </div>
          </form>
        </div>
        @endif
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-primary">
          <thead>
            <TR>
              <TH rowspan="2">Nombre del solicitante</TH>
              <TH rowspan="2">CI</TH>
              <TH colspan="2" class="text-center">INICIO</TH>
              <TH colspan="2" class="text-center">FINALIZACION</TH>
              <TH rowspan="2">DIAS</TH>
              <TH rowspan="2">MOTIVO</TH>
              <TH rowspan="2" class="text-center">ESTADO</TH>
              <TH rowspan="2">OPCIONES</TH>
            </TR>
            <TR>
              <TH colspan="1" class="text-center">FECHA</TH>
              <TH colspan="1" class="text-center">HORA</TH>
              <TH colspan="1" class="text-center">FECHA</TH>
              <TH colspan="1" class="text-center">HORA</TH>
            </TR>
          </thead>
          @if($forms->count())
          @foreach($forms as $f)
          @php
          $date_ini = \Carbon\Carbon::parse($f->fecha_ini);
          $ini_fecha = $date_ini->format('Y-m-d');
          $ini_hora = $date_ini->format('H:i:s');
          $date_fin = \Carbon\Carbon::parse($f->fecha_fin);
          $fin_fecha = $date_fin->format('Y-m-d');
          $fin_hora = $date_fin->format('H:i:s');
          @endphp
          <tr>
            <td>{{$f->user->perfiles->nombre}} {{$f->user->perfiles->paterno}} {{$f->user->perfiles->materno}}</td>
            <td>{{$f->user->perfiles->ci}}</td>
            <td>{{$ini_fecha}}</td>
            <td>{{$ini_hora}}</td>
            <td>{{$fin_fecha}}</td>
            <td>{{$fin_hora}}</td>
            <td>{{$f->dias}}</td>
            <td>{{$f->motivo}}</td>
            <td class="text-center p-2">
              @if ($f->estado == null)
              <a href="{{ route('licencia.estadoForm',$f->id) }}" class="btn btn-primary p-0 pr-2 pl-2" style="font-size: 1.4rem;"><i class="fas fa-eye"></i></a>
              @elseif ($f->estado == 'Aceptada')
              <div class="d-flex flex-column">
                <a href="{{ route('licencia.estadoForm',$f->id) }}" class=""><i class="far fa-check-circle text-success" style="font-size: 2rem;"></i></a>
              </div>
              @elseif ($f->estado == 'Rechazada')
              <div class="d-flex flex-column">
                <a href="{{ route('licencia.estadoForm',$f->id) }}" class=""><i class="far fa-times-circle text-danger" style="font-size: 2rem;"></i></a>
              </div>
              @endif
            </td>
            <td>
              <div class="d-flex flex-row" style="gap: 4px;">
              @if ($f->estado != null)
              <a class="btn btn-info btn-xs" href="{{ route('licencia_pdf',$f->id,$f->user->id)}}" target="_blank"><span class="glyphicon glyphicon-pencil"><i class="fas fa-file-pdf"></i></span></a>
              @endif
                @if (Auth::user()->tienePermiso(18,3) && $f->estado == null)
                <form action="{{ route ('licencia.destroy', $f->id) }}" method="POST" class="formEliminar">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
                @endif
              </div>
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td>No hay registro !!</td>
          </tr>
          @endif
        </table>
        {{ $forms->links() }}
      </div>
    </div>
  </div>
</div>
@endsection

@section('mis_scripts')
<script>
  $(document).ready(function() {
    $(".page-wrapper").removeClass("toggled");
  });
</script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
@endsection