<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/vacacion_pdf.css') }}">
</head>

<body>
    <div class="container">
        <div class="container_header">
            <div class="header header1">
                <img src="{{ asset('imagenes/logo_fondo.jpg') }}" alt="">
            </div>
            <div class="header header2">
                <h2>FORMULARIO ADMINISTRATIVO - RRHH</h2>
                <h2>SOLICITUD DE VACACIONES</h2>
            </div>
            <div class="header header3">
                <h3>LyPO/FARH/V.02</h3>
                <h3>No. 000001</h3>
                <h3>ADMINISTRACION</h3>
            </div>
        </div>
        <form method="GET" action="{{ route('vacacion.estado',$VacacionForm->id) }}" class="formRegistro">
            @csrf
            <div class="form-group1">
                <div class="item item1">
                    <label for="nombre" class="col-md-2 col-form-label text-md-right">
                        {{ __('FUNCIONARIO:') }}
                    </label>
                </div>
                <div class="item item2">
                    <input id="ci" type="text" value="{{$VacacionForm->user->nombre}} {{$VacacionForm->user->paterno}} {{$VacacionForm->materno}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
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
                    <input id="ci" type="text" value="{{$VacacionForm->user->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
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
                    <input id="cargo" type="text" value="{{$VacacionForm->user->cargo}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
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
                    <input id="area" type="text" value="{{$VacacionForm->user->area}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
                    @error('area')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group3">
                <textarea class="item" id="exampleFormControlTextarea1" rows="3" name="detalle_vacacion">{{$VacacionForm->detalle_vacacion}}</textarea>
            </div>
            <div class="form-group4">
                <div class="item item1">
                    <div class="text-center">
                        <h4>SOLICITADO</h4>
                    </div>
                    <div class="form-group">
                        <div class="fecha_label">
                            <label for="fecha_ini" class="">
                                {{ __('FECHA DE SALIDA') }}
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
                                {{ __('FECHA FINALIZACION') }}
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
                                {{ __('FECHA RETORNO') }}
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
                        <h4>AUTORIZADO</h4>
                    </div>
                    <div class="form-group">
                        <div class="fecha_label">
                            <label for="fecha_ini_aut" class="">
                                {{ __('FECHA DE SALIDA') }}
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
                                {{ __('FECHA FINALIZACION') }}
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
                                {{ __('FECHA RETORNO') }}
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
                        {{ __('DIAS DE VACACION') }}
                    </label>
                </div>
                <div class="">
                    <input id="dias_v" type="text" class="form-control @error('dias_v') is-invalid @enderror" name="dias_v" value="{{ $VacacionForm->dias_v }}" required autocomplete="dias_v">
                    @error('dias_v')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="">
                    <input id="dias_v_l" type="text" placeholder="Literal" class="form-control @error('dias_v') is-invalid @enderror" name="dias_v_l" value="{{ $VacacionForm->dias_v_l }}" required autocomplete="dias_v_l">
                    @error('dias_v_l')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group5">
                <div class="dias_label">
                    <label for="dias" class="">
                        {{ __('DIAS') }}
                    </label>
                </div>
                <div class="">
                    <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror" name="dias" value="{{ $VacacionForm->dias }}" required autocomplete="dias">
                    @error('dias')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="">
                    <input id="dias_l" type="text" placeholder="Literal" class="form-control @error('dias') is-invalid @enderror" name="dias_l" value="{{ $VacacionForm->dias_l }}" required autocomplete="dias">
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
                        {{ __('SALDO DIAS DE VACACION') }}
                    </label>
                </div>
                <div class="">
                    <input id="saldo_dias" name="saldo_dias" type="text" class="form-control @error('dias') is-invalid @enderror" value="{{ $VacacionForm->saldo_dias }}" required autocomplete="saldo_dias">
                    @error('dias')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="">
                    <input id="saldo_dias_l" type="text" placeholder="Literal" class="form-control @error('dias') is-invalid @enderror" name="saldo_dias_l" value="{{ $VacacionForm->saldo_dias_l }}" required autocomplete="dias">
                    @error('dias')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group6">
                <div class="item">
                    <div class="">
                        <h3 class="">Solicitante</h3>
                        <p class="">{{$VacacionForm->user->nombre}} {{$VacacionForm->user->paterno}} {{$VacacionForm->user->materno}}</p>
                        <label for="direc" class="">Cargo:</label>
                        <p class="">{{$VacacionForm->user->cargo}}</p>
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
