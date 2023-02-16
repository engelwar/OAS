<!DOCTYPE html>
<html lang="es">
<style>

</style>

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/vacacion_pdf.css') }}">
</head>

<body>
  @if ($VacacionForm->estado == 'Aceptada')
  <h1 id="sello1">ACEPTADO</h1>
  @elseif($VacacionForm->estado == 'Rechazada')
  <h1 id="sello2">Rechazado</h1>
  @endif
  <div class="containerA">
    <div class="container_header">
      <div class="header header1">
        <img src="{{ asset('imagenes/logo_fondo.jpg') }}" alt="">
      </div>
      <div class="header header2">
        <h2>FORMULARIO - RRHH</h2>
        <h2>SOLICITUD DE VACACIONES</h2>
      </div>
      <div class="header header3">
        <h3>LyPO/RRHH/FOL-V2</h3>
        <h3>No. {{ $VacacionForm->id }}</h3>
        <h3>ADMINISTRACION</h3>
      </div>
    </div>
    <form method="GET" action="{{ route('vacacion.estado',$VacacionForm->id) }}" class="formRegistro">
      @csrf
      <div class="form-group1">
        <div class="item item1">
          <label for="nombre" class="col-md-2 col-form-label text-md-right">
            {{ __('NOMBRE Y APELLIDO:') }}
          </label>
        </div>
        <div class="item item2">
          <input id="ci" type="text" value="{{$VacacionForm->user->perfiles->nombre}} {{$VacacionForm->user->perfiles->paterno}} {{$VacacionForm->user->perfiles->materno}}" class="form-control @error('ci') is-invalid @enderror input" name="ci">
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
          <input id="cargo" type="text" value="{{$VacacionForm->user->perfiles->cargo}}" class="form-control @error('cargo') is-invalid @enderror input" name="cargo">
          @error('sucursal')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group1">
        <div class="item item1">
          <label for="area" class="col-md-2 col-form-label text-md-right">
            {{ __('DEPARTAMENTO:') }}
          </label>
        </div>
        <div class="item item2">
          <input id="area" type="text" value="{{$VacacionForm->user->perfiles->unidad->nombre}}" class="form-control @error('area') is-invalid @enderror input" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete="area">
          @error('area')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="item item3">
          <label for="area" class="col-md-2 col-form-label text-md-right">
            {{ __('FECHA:') }}
          </label>
        </div>
        <div class="item item4">
          <input id="area" type="text" value="{{$VacacionForm->created_at}}" class="form-control @error('area') is-invalid @enderror input" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete="area">
          @error('area')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>


      </div>
      <div class="fg3">
        <textarea class="itemA" id="exampleFormControlTextarea1" rows="3" name="detalle_vacacion">{{$VacacionForm->detalle_vacacion}}</textarea>
      </div>
      <div class="form-group4">
        <div class="item item1">
          <div class="text-center">
            <h4 id="divAc">SOLICITADO</h4>
          </div>

          <div class="form-group">
            <div class="fecha_label">
              <label for="fecha_ini" class="">
                {{ __('1° día de Vacación:') }}
              </label>
            </div>
            <div class="fechas">

              <input id="fecha_ini" type="text" class="form-control form-control @error('fecha_ini') is-invalid @enderror" value="{{ $VacacionForm->fecha_ini }}" required autocomplete="fecha_ini">
              @error('fecha_ini')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <div class="fecha_label">
              <label for="fecha_fin" class="">
                {{ __('Último día de Vacación:') }}
              </label>
            </div>
            <div class="fechas">
              <input id="fecha_fin" type="text" class="form-control form-control @error('fecha_ifin') is-invalid @enderror" value="{{ $VacacionForm->fecha_fin }}" required autocomplete="fecha_fin">
              @error('fecha_fin')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <div class="fecha_label">
              <label for="fecha_ret" class="">
                {{ __('Retorno:') }}
              </label>
            </div>
            <div class="fechas">
              <input id="fecha_ret" type="text" class="form-control @error('fecha_ret') is-invalid @enderror" value="{{ $VacacionForm->fecha_ret }}" required autocomplete="fecha_ret">
              @error('fecha_ini')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="item item2">
          <div class="">
            <h4 id="divAb">AUTORIZADO</h4>
          </div>
          <div class="form-group">
            <div class="fecha_label">
              <label for="fecha_ini_aut" class="">
                {{ __('') }}
              </label>
            </div>
            <div class="fechas">
              <input id="fecha_ini_aut" type="text" class="form-control form-control @error('fecha_ini_aut') is-invalid @enderror" name="fecha_ini_aut" value="{{ $VacacionForm->fecha_ini_aut }}" autocomplete="fecha_ini_aut">
              @error('fecha_ini_aut')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <div class="fecha_label">
              <label for="fecha_fin_aut" class="">
                {{ __('') }}
              </label>
            </div>
            <div class="fechas">
              <input id="fecha_fin_aut" type="text" class="form-control form-control @error('fecha_fin_aut') is-invalid @enderror" name="fecha_fin_aut" value="{{ $VacacionForm->fecha_fin_aut }}" autocomplete="fecha_fin_aut">
              @error('fecha_fin_aut')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <div class="fecha_label">
              <label for="fecha_ret_aut" class="">
                {{ __('') }}
              </label>
            </div>
            <div class="fechas">
              <input id="fecha_ret_aut" type="text" class="form-control @error('fecha_ret_aut') is-invalid @enderror" name="fecha_ret_aut" value="{{ $VacacionForm->fecha_ret_aut }}" autocomplete="fecha_ret_aut">
              @error('fecha_ret_aut')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="form-group5">
        <div class="dias_label">
          <label for="dias_v" class="">
            {{ __('VACACIONES PENDIENTES') }}
          </label>
        </div>
        <div class="">
          <input id="dias_v" type="text" class="form-control @error('dias_v') is-invalid @enderror inputV2" name="dias_v" value="{{ $VacacionForm->dias_v }}" required autocomplete="dias_v">
          @error('dias_v')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group5">
        <div class="dias_label">
          <label for="dias" class="">
            {{ __('VACACIONES AUTORIZADAS') }}
          </label>
        </div>
        <div class="">
          <input id="dias_v" type="text" class="form-control @error('dias') is-invalid @enderror inputV2" name="dias" value="{{ $VacacionForm->dias }}" required autocomplete="dias">
          @error('dias')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

      </div>
      <div class="form-group5">
        <div class="dias_label">
          <label for="saldo_dias" class="">
            {{ __('SALDO VACACIONES PENDIENTES') }}
          </label>
        </div>
        <div class="">
          <input id="dias_v" name="saldo_dias" type="text" class="form-control @error('dias') is-invalid @enderror inputV2" value="{{ $VacacionForm->saldo_dias }}" required autocomplete="saldo_dias">
          @error('dias')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <br>
      <div class="form-group1A">
        <div class="item item1A">
          <label for="nombre" class="col-md-2 col-form-label text-md-right">
            {{ __('PRIMERA AUTORIZACION:') }}
          </label>
        </div>
        <div class="item item2A">
          <input id="ci" type="text" value="{{$VacacionForm->jefe->perfiles->nombre}} {{$VacacionForm->jefe->perfiles->paterno}} {{$VacacionForm->jefe->perfiles->materno}}" class="form-control @error('ci') is-invalid @enderror input" name="ci">
        </div>
        <div class="item item3A">
          <label for="cargo" class="">
            {{ __('CARGO:') }}
          </label>
        </div>
        <div class="item item4A">
          <input id="cargo" type="text" value="{{$VacacionForm->jefe->perfiles->cargo}}" class="form-control @error('cargo') is-invalid @enderror input">
          @error('sucursal')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item5A">
          _________________
        </div>
      </div>
      <div class="form-group1A">
        <div class="item item1A">
          <label for="nombre" class="col-md-2 col-form-label text-md-right">
            {{ __('SEGUNDA AUTORIZACION:') }}
          </label>
        </div>
        <div class="item item2A">
          <input id="ci" type="text" value="{{$VacacionForm->admin->perfiles->nombre}} {{$VacacionForm->admin->perfiles->paterno}} {{$VacacionForm->admin->perfiles->materno}}" class="form-control @error('ci') is-invalid @enderror input" name="ci">
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
          <input id="cargo" type="text" value="{{$VacacionForm->admin->perfiles->cargo}}" class="form-control @error('cargo') is-invalid @enderror input">
          @error('sucursal')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="item item5A">
          _________________
        </div>
      </div>
  </div>
  </form>
  </div>
</body>

</html>