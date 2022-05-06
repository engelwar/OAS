<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/licencia_pdf.css') }}">
</head>

<body>
    <div class="container">
        <div class="container_header">
            <div class="header header1">
                <img src="{{ asset('imagenes/logo_fondo.jpg') }}" alt="">
            </div>
            <div class="header header2">
                <h2>FORMULARIO DE LICENCIA CON GOCE DE HABERES</h2>
            </div>
            <div class="header header3">
                <h3>LyPO/FARH/V.02</h3>
                <h3>No. 000001</h3>
                <h3>ADMINISTRACION</h3>
            </div>
        </div>
        <form method="GET" action="{{ route('licencia.estado',$LicenciaForm->id) }}" class="formRegistro">
            @csrf
            <div class="form-group1">
                <div class="item item1">
                    <label for="nombre" class="col-md-2 col-form-label text-md-right">
                        {{ __('FUNCIONARIO:') }}
                    </label>
                </div>
                <div class="item item2">
                    <input id="ci" type="text" value="{{$LicenciaForm->user->perfiles->nombre}} {{$LicenciaForm->user->perfiles->paterno}} {{$LicenciaForm->user->perfiles->materno}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
                    @error('ci')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="item item3">
                    <label for="ci" class="">
                        {{ __('CI:') }}
                    </label>
                </div>
                <div class="item item4">
                    <input id="ci" type="text" value="{{$LicenciaForm->user->perfiles->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
                    @error('sucursal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="item item5">
                    <label for="cargo" class="">
                        {{ __('CARGO:') }}
                    </label>
                </div>
                <div class="item item6">
                    <input id="cargo" type="text" value="{{$LicenciaForm->user->perfiles->unidad->nombre}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
                    @error('sucursal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group2">
                <div class="item item1">
                    <label for="area" class="col-md-2 col-form-label text-md-right">
                        {{ __('UNIDAD:') }}
                    </label>
                </div>
                <div class="item item2">
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
            <div class="form-group4">
                <div class="item item_label">
                    <label for="respaldo" class="">
                        {{ __('Respaldo') }}
                    </label>
                </div>
                <div class="item item_input">
                    <input id="respaldo" type="text" class="form-control @error('respaldo') is-invalid @enderror" name="respaldo" value="{{ $LicenciaForm->respaldo }}" required autocomplete="respaldo">
                    @error('respaldo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group5">
                <div class="item">
                    <div class="">
                        <h3 class="">Solicitante</h3>
                        <p class="">{{$LicenciaForm->user->nombre}} {{$LicenciaForm->user->paterno}} {{$LicenciaForm->user->materno}}</p>
                        <label for="direc" class="">Cargo:</label>
                        <p class="">{{$LicenciaForm->user->cargo}}</p>
                        <p class="firma">....................................................</p>
                        <label for="direc" class="">
                            FIRMA
                        </label>
                    </div>
                </div>
                <div class="item">
                    <div class="">
                        <h3 class="">Inmediato superior</h3>
                        <p class="">....................................................</p>
                        <label for="direc" class="">Cargo:</label>
                        <p class="">....................................................</p>
                        <p class="firma">....................................................</p>
                        <label for="direc" class="">
                            FIRMA
                        </label>
                    </div>
                </div>
                <div class="item">
                    <div class="">
                        <h3 class="">Gerente administrativo</h3>
                        <p class="">....................................................</p>
                        <label for="direc" class="">Cargo:</label>
                        <p class="">....................................................</p>
                        <p class="firma">....................................................</p>
                        <label for="direc" class="">
                            FIRMA
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
