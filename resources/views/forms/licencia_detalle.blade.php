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
                <input id="nombre" type="text" value="{{$LicenciaForm->user->nombre}} {{$LicenciaForm->user->paterno}} {{$LicenciaForm->user->materno}}" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
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
                <input id="ci" type="ci" value="{{$LicenciaForm->user->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
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
                <input id="cargo" type="cargo" value="{{$LicenciaForm->user->cargo}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
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
                <input id="area" type="text" value="{{$LicenciaForm->user->area}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
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
                <input id="fecha_fin" type="date" class="form-control form-control @error('fecha_ifin') is-invalid @enderror" name="fecha_fin" value="{{ $fin_fecha }}" required autocomplete="fecha_fin">
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
                <input id="hora_ini" type="time" class="form-control form-control @error('hora_ini') is-invalid @enderror" name="hora_ini" value="{{ $ini_hora }}" required autocomplete="hora_ini">
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
                <input id="hora_fin" type="time" class="form-control form-control @error('hora_fin') is-invalid @enderror" name="hora_fin" value="{{ $fin_hora }}" required autocomplete="hora_fin">
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
                <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror" name="dias" value="{{ $LicenciaForm->dias }}" required autocomplete="dias">
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
                <input id="horas" type="text" class="form-control @error('horas') is-invalid @enderror" name="horas" value="{{ $LicenciaForm->horas }}" required autocomplete="horas">
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
                <input id="motivo" type="text" class="form-control @error('motivo') is-invalid @enderror" name="motivo" value="{{ $LicenciaForm->motivo }}" required autocomplete="motivo">
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
                <input id="respaldo" type="text" class="form-control @error('respaldo') is-invalid @enderror" name="respaldo" value="{{ $LicenciaForm->respaldo }}" required autocomplete="respaldo">
                @error('respaldo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row justify-content-center" style="margin-top:50px;">
            <div class="col-3">
                <div class="form-group row d-flex justify-content-center">
                    <h5>FUNCIONARIO</h5>
                    <label class="text-center w-100">
                        {{$LicenciaForm->user->nombre}} {{$LicenciaForm->user->paterno}} {{$LicenciaForm->user->materno}}
                    </label>
                    <label class="text-center">{{$LicenciaForm->user->cargo}}</label>
                </div>
            </div>
        </div>

        @if (Auth::user()->rol == 'admin')
        <div class="d-flex justify-content-center" style="gap: 10px;">
            <button name="estado" type="submit" class="button btn btn-danger btn-xs" value="Aceptada"><i class="fas fa-check mr-2"></i>Aceptar</button>
            <button name="estado" type="submit" class="button btn btn-primary btn-xs" value="Rechazada"><i class="fas fa-times mr-2"></i>Rechazar</button>
        </div>
        @elseif (Auth::user()->rol != 'admin' && $LicenciaForm->estado != null)
        <h4 class="text-bold text-danger text-center">{{$LicenciaForm->estado}}</h4>
        @endif
    </form>

</div>
@endsection
