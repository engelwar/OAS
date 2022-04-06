@extends('layouts.app')

@section('estilo')

@endsection

@section('content')
<div class="container center border" style="padding:50px;">
    <form method="POST" action="{{ route('licencia.store') }}" class="formRegistro">
        @csrf
        <div class=" row d-flex justify-content-center">
            <div class="col-3"></div>
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
                <input id="nombre" type="text" value="{{Auth::user()->nombre}} {{Auth::user()->paterno}} {{Auth::user()->materno}}" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
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
                <input id="ci" type="ci" value="{{Auth::user()->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
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
                <input id="cargo" type="cargo" value="{{Auth::user()->cargo}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
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
                <input id="area" type="text" value="{{Auth::user()->area}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
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





        <div class="row justify-content-between" style="margin-top:70px;">
            <div class="col-4">
                <div class="form-group d-flex flex-column align-items-center">
                    <h5 class="mb-4">FUNCIONARIO</h5>
                    <p class="mb-0">....................................................</p>
                    <h3>FIRMA</h3>
                    <label for="direc" class="text-md-right">
                        Nombre completo de funcionario:
                    </label>
                    <p class="mb-0">{{Auth::user()->nombre.' '.Auth::user()->paterno.' '.Auth::user()->materno}}</p>
                    <label for="direc" class="mt-2">Cargo:</label>
                    <p class="mb-0">{{Auth::user()->cargo}}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group d-flex flex-column align-items-center text-center">
                    <h5 class="mb-4">AUTORIZACION</h5>
                    <p class="mb-0">....................................................</p>
                    <h3>FIRMA</h3>
                    <label for="direc" class="">
                        Nombre completo de administracion:
                    </label>
                    <p class="mb-0">....................................................</p>
                    <label for="direc" class="col-md-4 col-form-label">Cargo:</label>
                    <p class="mb-0">....................................................</p>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group d-flex flex-column align-items-center text-center">
                    <h5 class="mb-4">RRHH</h5>
                    <p class="mb-0">....................................................</p>
                    <h3>FIRMA</h3>
                    <label for="direc" class="">
                        Nombre completo de administracion:
                    </label>
                    <p class="mb-0">....................................................</p>
                    <label for="direc" class="col-md-4 col-form-label">Cargo:</label>
                    <p class="mb-0">....................................................</p>
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
