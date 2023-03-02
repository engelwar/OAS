@extends('layouts.app')

@section('estilo')

@endsection

@section('content')
<div class="container my-5 center border" style="padding:100px;">
  <form method="POST" action="{{ route('licencia.store') }}">
    @csrf
    <div class=" row d-flex justify-content-center">
      <div class="col-3">
        <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}" />
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
        <input id="nombre" type="text" value="{{Auth::user()->perfiles->nombre}} {{Auth::user()->perfiles->paterno}} {{Auth::user()->perfiles->materno}}" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
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
        <input id="ci" type="ci" value="{{Auth::user()->perfiles->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
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
        <input id="cargo" type="cargo" value="{{Auth::user()->perfiles->cargo}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
        @error('sucursal')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="area" class="col-md-2 col-form-label text-md-right">
        {{ __('UNIDAD') }}
      </label>
      <div class="col-md-4">
        <input id="area" type="text" value="{{Auth::user()->perfiles->unidad->nombre}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
        @error('area')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="fecha_ini" class="col-md-2 col-form-label text-md-right">
        {{ __('Fecha De Salida') }}
      </label>
      <div class="col-md-3">
        <input id="fecha_ini" type="date" class="form-control form-control @error('fecha_ini') is-invalid @enderror" name="fecha_ini" value="{{ old('fecha_ini') }}" required autocomplete="fecha_ini">
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
        <input id="fecha_fin" type="date" class="form-control form-control @error('fecha_ifin') is-invalid @enderror d-none" name="fecha_fin" value="{{ old('fecha_fin') }}" required autocomplete="fecha_fin">
        <input id="fecha_fin_a" type="date" class="form-control form-control @error('fecha_ifin') is-invalid @enderror" value="{{ old('fecha_fin_a') }}" required autocomplete="fecha_fin_a" disabled>
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
        <input step=”any” id="hora_ini" type="time" class="form-control form-control @error('hora_ini') is-invalid @enderror" name="hora_ini" value="{{ old('hora_ini') }}" required autocomplete="hora_ini">
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
        <input id="hora_fin" type="time" class="form-control form-control @error('hora_fin') is-invalid @enderror d-none" name="hora_fin" value="{{ old('hora_fin') }}" required autocomplete="hora_fin">
        <input id="hora_fin_a" type="time" class="form-control form-control @error('hora_fin') is-invalid @enderror" value="{{ old('hora_fin') }}" required autocomplete="hora_fin" disabled>
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
        <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror d-none" name="dias" value="{{ old('dias') }}" required autocomplete="dias">
        <input id="dias_a" type="text" class="form-control @error('dias_a') is-invalid @enderror" value="{{ old('dias_a') }}" required autocomplete="dias_a" disabled>
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
          <option selected value=1>1</option>
          <option value=2>2</option>
          <option value=3>3</option>
          <option value=4>4</option>
        </select>
      </div>
    </div>
    <div class="form-group row d-flex">
      <label for="motivo" class="col-md-2 col-form-label text-md-right">
        {{ __('Motivo De Licencia') }}
      </label>
      <div class="col-md-10">
        <input id="motivo" type="text" class="form-control @error('motivo') is-invalid @enderror" name="motivo" value="{{ old('motivo') }}" required autocomplete="motivo">
        @error('motivo')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="autoriza" class="col-md-2 col-form-label text-md-right">
        {{ __('Autoriza') }}
      </label>
      <div class="col-md-4">
        <select name="jefe" id="jefe" class="form-control" required>
          <option value="" disabled selected>Seleccione Inmediato Superior</option>
          
            @foreach(App\Perfil::orderBy('nombre')->get(); as $u)
          @if (strpos($u->cargo,'JEFE') == 0 && $u->area_id != 3)
          <option value="{{$u->user_id}}">{{$u->nombre}} {{$u->paterno}} {{$u->materno}}</option>
          @endif
          @endforeach
            
            <!-- <option value="51">Denis Morales</option> -->
          
        </select>
      </div>
    </div>
    <div class="form-group row d-flex justify-content-center mt-5">
      <div class="col-md-10 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">
          {{ __('Enviar') }}
        </button>
      </div>
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
      $("#dias_a").val('Medio dia');
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
      $("#dias_a").val('Medio dia');
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