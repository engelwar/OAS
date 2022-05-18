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
        <input id="fecha_fin" type="date" class="form-control form-control @error('fecha_ifin') is-invalid @enderror" name="fecha_fin" value="{{ old('fecha_fin') }}" required autocomplete="fecha_fin">
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
        <input id="hora_ini" type="time" class="form-control form-control @error('hora_ini') is-invalid @enderror" name="hora_ini" value="{{ old('hora_ini') }}" required autocomplete="hora_ini">
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
        <input id="hora_fin" type="time" class="form-control form-control @error('hora_fin') is-invalid @enderror" name="hora_fin" value="{{ old('hora_fin') }}" required autocomplete="hora_fin">
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
        <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror" name="dias" value="{{ old('dias') }}" required autocomplete="dias">
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
        <input id="horas" type="text" class="form-control @error('horas') is-invalid @enderror" name="horas" value="{{ old('horas') }}" required autocomplete="horas">
        @error('horas')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
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
    <div class="form-group row d-flex">
      <label for="respaldo" class="col-md-2 col-form-label text-md-right">
        {{ __('Respaldo') }}
      </label>

      <div class="col-md-10">
        <input id="respaldo" type="text" class="form-control @error('respaldo') is-invalid @enderror" name="respaldo" value="{{ old('respaldo') }}" required autocomplete="respaldo">
        @error('respaldo')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="d-flex w-100 mb-2">
      <div class="w-100">
        <div>
          <label for="superior" class="col-md-3 col-form-label text-md-right ml-auto">
            {{ __('Inmediato Superior') }}
          </label>
        </div>
        <div>
          <select class="form-select" size="3" aria-label="size 3 select example" name="superior" required>
            @foreach ($users as $u)
            <option value="{{ $u->user_id }}">{{ $u->nombre }} {{ $u->paterno }} {{ $u->materno }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="w-100">
        <div>
          <label for="administrativo" class="col-form-label text-md-right ml-auto">
            {{ __('Gerente Administrativo') }}
          </label>
        </div>
        <div>
          <select class="form-select" size="3" aria-label="size 3 select example" name="administrativo" required>
            @foreach ($users as $u)
            <option value="{{ $u->user_id }}">{{ $u->nombre }} {{ $u->paterno }} {{ $u->materno }}</option>
            @endforeach
          </select>
        </div>
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
@endsection