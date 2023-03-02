@extends('layouts.app')

@section('estilo')

@endsection

@section('content')
<div class="container center border" style="padding:50px;">
  <form method="GET" action="{{ route('licencia.estado',$LicenciaForm->id) }}" class="">
    @csrf
    <div class=" row d-flex justify-content-center">
      <div class="col-3">
        <a href="{{ route('licencia.index') }}" class="btn btn-danger">Volver</a>
      </div>
      <div class="col-6 d-flex align-items-center justify-content-center">
        <h3 class="text-center text-primary">FORMULARIO DE LICENCIA CON GOCE DE HABERES</h3>
      </div>
      <div class="col-3 d-flex align-items-center justify-content-end">
        <h4 style="color:red">Nro. </h4>
      </div>
    </div>

    <div class="form-group row pt-5">
      <label for="nombre" class="col-md-2 col-form-label text-md-right">
        {{ __('FUNCIONARIO') }}
      </label>
      <div class="col-md-4">
        <input id="nombre" type="text" value="{{$LicenciaForm->user->perfiles->nombre}} {{$LicenciaForm->user->perfiles->paterno}} {{$LicenciaForm->user->perfiles->materno}}" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <label for="ci" class="col-md-1 col-form-label text-md-right">
        {{ __('CI') }}
      </label>
      <div class="col-md-2">
        <input id="ci" type="ci" value="{{$LicenciaForm->user->perfiles->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
        @error('ci')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <label for="cargo" class="col-md-1 col-form-label text-md-right">
        {{ __('CARGO') }}
      </label>
      <div class="col-md-2">
        <input id="cargo" type="cargo" value="{{$LicenciaForm->user->perfiles->cargo}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
        @error('sucursal')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <input type="text" id="admin" value="{{auth()->user()->perfiles->nombre}} {{auth()->user()->perfiles->paterno}} " hidden>
    <div class="form-group row">
      <label for="area" class="col-md-2 col-form-label text-md-right">
        {{ __('UNIDAD') }}
      </label>

      <div class="col-md-4">
        <input id="area" type="text" value="{{$LicenciaForm->user->perfiles->unidad->nombre}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" required autocomplete="area">
        @error('area')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    @php
    $date_ini = \Carbon\Carbon::parse($LicenciaForm->fecha_ini);
    $ini_fecha = $date_ini->format('Y-m-d');
    $ini_hora = $date_ini->format('H:i:s');
    $date_fin = \Carbon\Carbon::parse($LicenciaForm->fecha_fin);
    $fin_fecha = $date_fin->format('Y-m-d');
    $fin_hora = $date_fin->format('H:i:s');
    @endphp
    <div class="form-group row">
      <label for="fecha_ini" class="col-md-2 col-form-label text-md-right">
        {{ __('Fecha De Salida') }}
      </label>

      <div class="col-md-3">
        <input id="fecha_ini" type="date" class="form-control form-control @error('fecha_ini') is-invalid @enderror" name="fecha_ini" value="{{ $ini_fecha }}" required autocomplete="fecha_ini">
        @error('fecha_ini')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <label for="fecha_fin" class="col-md-3 ml-auto col-form-label text-md-right">
        {{ __('Fecha De Retorno') }}
      </label>
      <div class="col-md-3 ">
        <input id="fecha_fin" type="date" class="form-control form-control @error('fecha_fin') is-invalid @enderror d-none" name="fecha_fin" value="{{ $fin_fecha }}" required autocomplete="fecha_fin">
        <input id="fecha_fin_a" type="date" class="form-control form-control @error('fecha_fin_a') is-invalid @enderror" value="{{ $fin_fecha }}" required autocomplete="fecha_fin" disabled>
        @error('fecha_fin')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="hora_ini" class="col-md-2 col-form-label text-md-right">
        {{ __('Hora De Salida') }}
      </label>
      <div class="col-md-3">
        <input step=”any” id="hora_ini" type="time" class="form-control form-control @error('hora_ini') is-invalid @enderror" name="hora_ini" value="{{ $ini_hora }}" required autocomplete="hora_ini">
        @error('hora_ini')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <label for="hora_fin" class="col-md-3 ml-auto col-form-label text-md-right">
        {{ __('Hora De Retorno') }}
      </label>
      <div class="col-md-3 ">
        <input id="hora_fin" type="time" class="form-control form-control @error('hora_fin') is-invalid @enderror d-none" name="hora_fin" value="{{ $fin_hora }}" required autocomplete="hora_fin">
        <input id="hora_fin_a" type="time" class="form-control form-control @error('hora_fin') is-invalid @enderror" value="{{ $fin_hora }}" required autocomplete="hora_fin" disabled>
        @error('hora_fin')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row d-flex">
      <label for="dias" class="col-md-2 col-form-label text-md-right">
        {{ __('Días De Licencia') }}
      </label>

      <div class="col-md-3">
        <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror d-none" name="dias" value="{{ $LicenciaForm->dias }}" required autocomplete="dias">
        <input id="dias_a" type="text" class="form-control @error('dias_a') is-invalid @enderror" value="{{ $LicenciaForm->dias }}" required autocomplete="dias_a" disabled>
        @error('dias')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <label for="horas" class="col-md-3 col-form-label text-md-right">
        {{ __('Horas De Licencia') }}
      </label>

      <div class="col-md-4">
        <select id="horas" class="form-select" aria-label="Default select example" name="horas">
          <option @if ($LicenciaForm->horas == 1) selected @endif value=1>1</option>
          <option @if ($LicenciaForm->horas == 2) selected @endif value=2>2</option>
          <option @if ($LicenciaForm->horas == 3) selected @endif value=3>3</option>
          <option @if ($LicenciaForm->horas == 4) selected @endif value=4>4</option>
        </select>
      </div>
    </div>
    <div class="form-group row d-flex">
      <label for="motivo" class="col-md-2 col-form-label text-md-right">
        {{ __('Motivo De Licencia') }}
      </label>

      <div class="col-md-10">
        <input id="motivo" type="text" class="form-control @error('motivo') is-invalid @enderror" name="motivo" value="{{ $LicenciaForm->motivo }}" required autocomplete="motivo">
        @error('motivo')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row d-flex">
      <label for="dias" class="col-md-2 col-form-label text-md-right">
        {{ __('Jefe Inmediato') }}
      </label>
      <div class="col-md-4">
        <select id="horas" class="form-select" aria-label="Default select example" name="horas">
          <option value="" disabled selected>Seleccione Inmediato Superior</option>
          @foreach(App\Perfil::orderBy('nombre')->get(); as $u)
          @if (strpos($u->cargo,'JEFE') == 0 && $u->area_id != 3)
          <option value="{{$u->user_id}}" @if($u->user_id == $LicenciaForm->jefe_id) selected @endif>{{$u->nombre}} {{$u->paterno}} {{$u->materno}}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>
    @if (Auth::user()->tienePermiso(18,2))
    <div class="d-flex justify-content-center mt-2" style="gap: 10px;">
      <button name="estado" type="submit" class="button btn btn-success btn-xs" value="Aceptada"><i class="fas fa-check mr-2"></i>Aceptar</button>
      <button name="estado" type="submit" class="button btn btn-danger btn-xs" value="Rechazada"><i class="fas fa-times mr-2"></i>Rechazar</button>
    </div>
    @elseif (Auth::user()->rol != 'admin' && $LicenciaForm->estado != null)
    <h4 class="text-bold text-danger text-center">{{$LicenciaForm->estado}}</h4>
    @endif
    <div class="m-auto form-group row col-md-10">
      <label for="detalle_estado" class="col-md-3 col-form-label text-md-right ml-auto">
        {{ __('MOTIVO:') }}
      </label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detalle_estado">{{$LicenciaForm->detalle_estado}}</textarea>
    </div>
  </form>
</div>
@section('mis_scripts')
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script>
  document.getElementById("fecha_ini").addEventListener("click", function() {
    var fecha_ini = moment($("#fecha_ini").val() + ' ' + $("#hora_ini").val());
    $("#fecha_fin").val($("#fecha_ini").val());
    $("#fecha_fin_a").val($("#fecha_ini").val());
  });
  document.getElementById("hora_ini").addEventListener("blur", function() {
    var fecha_ini = moment($("#fecha_ini").val() + ' ' + $("#hora_ini").val());
    $("#fecha_fin").val($("#fecha_ini").val());
    $("#fecha_fin_a").val($("#fecha_ini").val());
    var horas = $("#horas").val();
    if (parseInt(horas) == 4) {
      $("#dias").val(0.5);
      $("#dias_a").val(0.5);
    } else {
      $("#dias").val(0);
      $("#dias_a").val(0);
    }
    var a1 = parseInt($("#hora_ini").val()) + Number(horas);
    var a2 = $("#hora_ini").val();
    if (a1 == 24) {
      a1 = "00";
    }
    if (a1 < 10) {
      a1 = "0" + a1;
    }
    $("#hora_fin").val(a1 + ":" + a2[3] + a2[4]);
    $("#hora_fin_a").val(a1 + ":" + a2[3] + a2[4]);
  });
  document.getElementById("horas").addEventListener("click", function() {
    var fecha_ini = moment($("#fecha_ini").val() + ' ' + $("#hora_ini").val());
    $("#fecha_fin").val($("#fecha_ini").val());
    $("#fecha_fin_a").val($("#fecha_ini").val());
    var horas = $("#horas").val();
    if (parseInt(horas) == 4) {
      $("#dias").val(0.5);
      $("#dias_a").val(0.5);
    } else {
      $("#dias").val(0);
      $("#dias_a").val(0);
    }
    var a1 = parseInt($("#hora_ini").val()) + Number(horas);
    var a2 = $("#hora_ini").val();
    if (a1 == 24) {
      a1 = "00";
    }
    if (a1 < 10) {
      a1 = "0" + a1;
    }
    $("#hora_fin").val(a1 + ":" + a2[3] + a2[4]);
    $("#hora_fin_a").val(a1 + ":" + a2[3] + a2[4]);
  });
</script>
@endsection
@endsection