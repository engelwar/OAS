@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
<div class="container my-5 center border" style="padding:100px;" >
    <form method="POST" action="{{ route('vacacion.update', $form->id) }}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class=" row d-flex justify-content-center">
            <div class="col-3">
                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center">
                <h3 class="text-center text-primary">FORMULARIO VACACIONES</h3>
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
                <input id="nombre" type="text" value="{{$form->user->nombre}} {{$form->user->paterno}} {{$form->user->materno}}" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
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
                <input id="ci" type="ci" value="{{$form->user->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
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
                <input id="cargo" type="cargo" value="{{$form->user->cargo}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
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
                <input id="area" type="text" value="{{$form->user->area}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
                @error('area')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="fecha_ini" class="col-md-2 col-form-label text-md-right">
                {{ __('FECHA DE SALIDA') }}
            </label>
                    
            <div class="col-md-3">
                <input id="fecha_ini" type="date" class="form-control form-control @error('fecha_ini') is-invalid @enderror" name="fecha_ini" value="{{ $form->fecha_ini}}" required autocomplete="fecha_ini">
                @error('fecha_ini')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="fecha_fin" class="col-md-3 ml-auto col-form-label text-md-right">
                {{ __('FECHA FINALIZACION') }}
            </label>
                    
            <div class="col-md-3 ">
                <input id="fecha_fin" type="date" class="form-control form-control @error('fecha_ifin') is-invalid @enderror" name="fecha_fin" value="{{ $form->fecha_fin }}" required autocomplete="fecha_fin">
                @error('fecha_fin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
                       
        <div class="form-group row">
            <label for="fecha_ret" class="col-md-2 col-form-label text-md-right">
                {{ __('FECHA RETORNO') }}
            </label>
                    
            <div class="col-md-3">
                <input id="fecha_ret" type="date" class="form-control @error('fecha_ret') is-invalid @enderror" name="fecha_ret" value="{{ $form->fecha_ret }}" required autocomplete="fecha_ret">
                @error('fecha_ini')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>     
        <div class="form-group row d-flex">
            <label for="dias_v" class="col-md-2 col-form-label text-md-right ml-auto">
                {{ __('DIAS DE VACACION') }}
            </label>
                    
            <div class="col-md-1">
                <input id="dias_v" type="text" class="form-control @error('dias_v') is-invalid @enderror" name="dias_v" value="{{ $form->dias_v }}" required autocomplete="dias_v">
                    @error('dias_v')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
                   
            <div class="col-md-4">
                <input id="dias_v_l" type="text" placeholder="Literal" class="form-control @error('dias_v') is-invalid @enderror" name="dias_v_l" value="{{ $form->dias_v_l }}" required autocomplete="dias_v_l">
                    @error('dias_v_l')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div>
        
        <div class="form-group row">
        <label for="dias" class="col-md-2 col-form-label text-md-right ml-auto">
                {{ __('DIAS') }}
            </label>
                    
            <div class="col-md-1">
                <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror" name="dias" value="{{ $form->dias}}" required autocomplete="dias">
                    @error('dias')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="col-md-4">
                <input id="dias_l" type="text" placeholder="LITERAL" class="form-control @error('dias') is-invalid @enderror" name="dias_l" value="{{ $form->dias_l }}" required autocomplete="dias">
                    @error('dias')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div> 

        <div class="form-group row">
            <label for="saldo_dias" class="col-md-3 col-form-label text-md-right ml-auto">
                {{ __('SALDO DIAS DE VACACION') }}
            </label>
                    
            <div class="col-md-1">
                <input id="saldo_dias" name="saldo_dias" type="text" class="form-control @error('dias') is-invalid @enderror" value="{{ $form->saldo_dias }}" required autocomplete="saldo_dias">
                    @error('dias')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="col-md-4">
                <input id="saldo_dias_l" type="text" placeholder="LITERAL" class="form-control @error('dias') is-invalid @enderror" name="saldo_dias_l" value="{{ $form->saldo_dias_l }}" required autocomplete="dias">
                    @error('dias')
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
        <div class="row justify-content-center">
            <div class="col-3">
            <a class="form-control btn btn-primary" href="{{route('vacacion.pdf', $form->id)}}">Generar PDF</a></div>
        </div>


    </form>

</div>
@endsection

