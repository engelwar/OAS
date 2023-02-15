<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/licencia_pdf.css') }}">
</head>

<body>
  @if ($LicenciaForm->estado == 'Aceptada')
  <h1 id="sello1">ACEPTADO</h1>
  @elseif($LicenciaForm->estado == 'Rechazada')
  <h1 id="sello2">Rechazado</h1>
  @endif
  @if ($LicenciaForm->estado ==null )
  <h1 id="sello3">Sin Procesar</h1>
  @endif
  <div class="containerA">
    <div class="container_header">
      <div class="header header1">
        <img src="{{ asset('imagenes/logo_fondo.jpg') }}" alt="">
      </div>
      <div class="header header2">
        <h2>FORMULARIO - RRHH</h2>
        <h2>SOLICITUD DE PERMISO</h2>
      </div>
      <div class="header header3">
        <h3>LyPO/RRHH/FOL-V2</h3>
        <h3>No. {{ $LicenciaForm->id }}</h3>
        <h3>ADMINISTRACION</h3>
      </div>
    </div>
    <form method="GET" action="{{ route('licencia.estado',$LicenciaForm->id) }}" class="formRegistro">
      @csrf
      <div class="form-group1">
        <div class="item item1">
          <label for="nombre" class="col-md-2 col-form-label text-md-right">
            {{ __('NOMBRE Y APELLIDO:') }}
          </label>
        </div>
        <div class="item item2">
          <input id="ci" type="text" value="{{$LicenciaForm->user->perfiles->nombre}} {{$LicenciaForm->user->perfiles->paterno}} {{$LicenciaForm->user->perfiles->materno}}" class="form-control @error('ci') is-invalid @enderror input" name="ci">
          @error('ci')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item3">
          <label for="cargo" class="">
            {{ __('CARGO:') }}
          </label>
        </div>
        <div class="item item4">
          <input id="ci" type="text" value="{{$LicenciaForm->user->perfiles->area->nombre}}" class="form-control @error('cargo') is-invalid @enderror input" name="cargo">
          @error('sucursal')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <br>
      <div class="form-group1">
        <div class="item item1">
          <label for="cargo" class="">
            {{ __('Departamento:') }}
          </label>
        </div>
        <div class="item item2">
          <input id="area" type="text" value="{{$LicenciaForm->user->perfiles->unidad->nombre}}" class="form-control @error('area') is-invalid @enderror input" name="area">
          @error('sucursal')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item3">
          <label for="area" class="col-md-2 col-form-label text-md-right">
            {{ __('Fecha:') }}
          </label>
        </div>
        <div class="item item4">
          <input id="area" type="text" value="{{$LicenciaForm->created_at}}" class="form-control @error('area') is-invalid @enderror input" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
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
      <br>
      <div class="form-group3">
        <div class="item item_label">
          <label for="fecha_ini" class="">
            {{ __('Fecha De Salida') }}
          </label>
        </div>
        <div class="item">
          <input id="fecha_ini" type="text" class="form-control form-control @error('fecha_ini') is-invalid @enderror" name="fecha_ini" value="{{ $ini_fecha }}" required autocomplete="fecha_ini">
          @error('fecha_ini')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item_label">
          <label for="fecha_fin" class="">
            {{ __('Fecha De Retorno') }}
          </label>
        </div>
        <div class="item">
          <input id="fecha_fin" type="text" class="form-control form-control @error('fecha_ifin') is-invalid @enderror" name="fecha_fin" value="{{ $fin_fecha }}" required autocomplete="fecha_fin">
          @error('fecha_fin')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group3">
        <div class="item item_label">
          <label for="hora_ini" class="">
            {{ __('Hora De Salida') }}
          </label>
        </div>
        <div class="item">
          <input id="hora_ini" type="text" class="form-control form-control @error('hora_ini') is-invalid @enderror" name="hora_ini" value="{{ $ini_hora }}" required autocomplete="hora_ini">
          @error('hora_ini')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item_label">
          <label for="hora_fin" class="">
            {{ __('Hora De Retorno') }}
          </label>
        </div>
        <div class="item">
          <input id="hora_fin" type="text" class="form-control form-control @error('hora_fin') is-invalid @enderror" name="hora_fin" value="{{ $fin_hora }}" required autocomplete="hora_fin">
          @error('hora_fin')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group3">
        <div class="item item_label">
          <label for="dias" class="">
            {{ __('Días De Licencia') }}
          </label>
        </div>
        <div class="item">
          <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror" name="dias" value="{{ $LicenciaForm->dias }}" required autocomplete="dias">
          @error('dias')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item_label">
          <label for="horas" class="">
            {{ __('Horas De Licencia') }}
          </label>
        </div>
        <div class="item">
          <input id="horas" type="text" class="form-control @error('horas') is-invalid @enderror" name="horas" value="{{ $LicenciaForm->horas }}" required autocomplete="horas">
          @error('horas')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group4">
        <div class="item item_label">
          <label for="motivo" class="">
            {{ __('Motivo De Licencia') }}
          </label>
        </div>
        <div class="item item_input">
          <input id="motivo" type="text" class="form-control @error('motivo') is-invalid @enderror" name="motivo" value="{{ $LicenciaForm->motivo }}" required autocomplete="motivo">
          @error('motivo')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <br>
      <br>
      <br>
      <div class="form-group1A">
        <div class="item item1A">
          <label for="nombre" class="col-md-2 col-form-label text-md-right">
            {{ __('PRIMERA AUTORIZACION:') }}
          </label>
        </div>
        <div class="item item2A">
          <input id="ci" type="text" value="{{$LicenciaForm->jefe->perfiles->nombre}} {{$LicenciaForm->jefe->perfiles->paterno}} {{$LicenciaForm->jefe->perfiles->materno}}" class="form-control @error('ci') is-invalid @enderror input">
          @error('ci')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item3A">
          <label for="cargo" class="">
            {{ __('CARGO:') }}
          </label>
        </div>
        <div class="item item4A">
          <input id="cargo" type="text" value="{{$LicenciaForm->jefe->perfiles->cargo}} de {{$LicenciaForm->jefe->perfiles->area->nombre}}" class="form-control @error('cargo') is-invalid @enderror input">
          @error('sucursal')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="item item5A">
          ___________________________
        </div>
      </div>
      <br>
      <div class="form-group1A">
        <div class="item item1A">
          <label for="nombre" class="col-md-2 col-form-label text-md-right">
            {{ __('SEGUNDA AUTORIZACION:') }}
          </label>
        </div>
        <div class="item item2A">
          <input id="ci" type="text" value="{{$LicenciaForm->admin->perfiles->nombre}} {{$LicenciaForm->admin->perfiles->paterno}} {{$LicenciaForm->admin->perfiles->materno}}" class="form-control @error('ci') is-invalid @enderror input">
          @error('ci')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item3A">
          <label for="cargo" class="">
            {{ __('CARGO:') }}
          </label>
        </div>
        <div class="item item4A">
          <input id="cargo" type="text" value="{{$LicenciaForm->admin->perfiles->cargo}} de {{$LicenciaForm->admin->perfiles->area->nombre}}" class="form-control @error('cargo') is-invalid @enderror input">
          @error('sucursal')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item5A">
          ___________________________
        </div>
      </div>
    </form>
  </div>
</body>
</html>