@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
<div class="container my-5 center border" style="padding:100px;">
    <form method="POST" action="{{ route('licencia.update', $form->id) }}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class=" row d-flex justify-content-center">
            <div class="col-3">
                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
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
                <input id="fecha_ini" type="date" class="form-control form-control @error('fecha_ini') is-invalid @enderror" name="fecha_ini" value="{{date('Y-m-d',strtotime($form->fecha_ini))}}" required autocomplete="fecha_ini">
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
                <input id="fecha_fin" type="date" class="form-control form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin" value="{{date('Y-m-d',strtotime($form->fecha_fin))}}" required autocomplete="fecha_fin">
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
                <input id="hora_ini" type="time" class="form-control form-control @error('hora_ini') is-invalid @enderror" name="hora_ini" value="{{ date('H:i',strtotime($form->hora_ini)) }}" required autocomplete="hora_ini">
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
                <input id="hora_fin" type="time" class="form-control form-control @error('hora_fin') is-invalid @enderror" name="hora_fin" value="{{ date('H:i',strtotime($form->fecha_fin))}}" required autocomplete="hora_fin">
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
                <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror" name="dias" value="{{ $form->dias }}" required autocomplete="dias">
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
                <input id="horas" type="text" class="form-control @error('horas') is-invalid @enderror" name="horas" value="{{ $form->horas }}" required autocomplete="horas">
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
                <input id="motivo" type="text" class="form-control @error('motivo') is-invalid @enderror" name="motivo" value="{{ $form->motivo }}" required autocomplete="motivo">
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
                <input id="respaldo" type="text" class="form-control @error('respaldo') is-invalid @enderror" name="respaldo" value="{{ $form->respaldo }}" required autocomplete="respaldo">
                    @error('respaldo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div>
                        
    
        
        <div class="row justify-content-between" style="margin-top:100px;">
            <div class="col-3">
                <div class="row"><h5>FUNCIONARIO:</h5></div>
                <div class="form-group row d-flex justify-content-center">
                    <label for="direc" class="text-center w-100">
                    {{$form->user->nombre}} {{$form->user->paterno}} {{$form->user->materno}}
                    </label>  
                    <label for="direc" class="text-center">{{$form->user->cargo}}</label>      
                </div>
            </div>
            @if($firma)
            <div class="col-3">
                <div class="row"><h5>AUTORIZACION:</h5></div>
                <div class="form-group row d-flex justify-content-center">
                    <label for="direc" class="text-center w-100">
                        {{$firma->user->nombre}} {{$firma->user->paterno}} {{$firma->user->materno}}
                    </label>  
                    <label for="direc" class="text-center w-100">{{$firma->user->cargo}}</label>  
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#estado_rrhh"> 
                    {{$firma->estado}}
                    </button>
                    <!-- Modal Autorizar-->
                    <div class="modal fade" id="estado_rrhh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Observaciones</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <p>{{$firma->obs}}</p>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary" id="aceptado" name="aceptado" value="Aceptado">Aprobar</button>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            @endif
            @if($firma_rrhh)
            <div class="col-3">
                <div class="row"><h5>RRHH:</h5></div>
                <div class="form-group row d-flex justify-content-center">
                
                    <label for="direc" class="text-center w-100">
                    {{$firma_rrhh->user->nombre}} {{$firma_rrhh->user->paterno}} {{$firma_rrhh->user->materno}}
                    </label>  
                    <label for="direc" class="text-center w-100">{{$firma_rrhh->user->cargo}}</label>  
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#estado_rrhh"> 
                    {{$firma_rrhh->estado}}
                    </button>
                    <!-- Modal Autorizar-->
                    <div class="modal fade" id="estado_rrhh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Observaciones</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <p>{{$firma_rrhh->obs}}</p>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary" id="aceptado" name="aceptado" value="Aceptado">Aprobar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endif
        </div>

        <div class="form-group row d-flex justify-content-center mt-5">
            <div class="col-md-4 d-flex justify-content-center">
                @if(count($form->firmas->where('tipo', 'Superior'))<=0)
                <button type="button" class="btn btn-primary mr-4" data-toggle="modal" data-target="#modal_a"> 
                    {{ __('Autorizar') }}
                </button>
                <!-- Modal Autorizar-->
                <div class="modal fade" id="modal_a" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Aceptar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                    <textarea id="obs_a" name="obs_a" type="text" class="form-control" placeholder="Observaciones (Opcional)" style="white-space: nowrap;">

                                    </textarea>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="aceptado" name="aceptado" value="Aceptado">Aprobar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_r">
                    {{ __('Rechazar') }}
                </button>
                <!-- Modal Rechazar-->
                <div class="modal fade" id="modal_r" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Rechazar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea id="obs_r" name="obs_r" type="text" class="form-control" placeholder="Observaciones" style="white-space: nowrap;">

                                </textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger" id="rechazado" name="rechazado" value="Rechazado">Rechazar</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                @if(count($form->firmas->where('tipo', 'RRHH'))<=0)
                <button type="button" class="btn btn-primary mr-4" data-toggle="modal" data-target="#modal_arrhh"> 
                    {{ __('Autorizar RRHH') }}
                </button>

                <!-- Modal Autorizar-->
                <div class="modal fade" id="modal_arrhh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Aprobar como RRHH</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea id="obs_a_rrhh" name="obs_a_rrhh" type="text" class="form-control" placeholder="Observaciones (Opcional)" style="white-space: nowrap;">

                                </textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="aceptadorrhh" name="aceptadorrhh" value="Aceptado_RRHH">Aprobar como RRHH</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal_rrrhh">
                    {{ __('Rechazar RRHH') }}
                </button>
                <!-- Modal Rechazar-->
                <div class="modal fade" id="modal_rrrhh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Rechazar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea id="obs_r_rrhh" name="obs_r_rrhh" type="text" class="form-control" placeholder="Observaciones" style="white-space: nowrap;">

                                </textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger" id="rechazadorrhh" name="rechazadorrhh" value="Rechazado_RRHH">Rechazar como RRHH</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>



    </form>
</div>
    @endsection