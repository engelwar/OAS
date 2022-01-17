@extends('layouts.app')

@section('mi_estilo')
 <style>
     @media (min-width: 600px) {
  .container_pad {
    padding:60px;
  }
}
 </style>
@endsection

@section('content')
<div class="container-lg my-lg-5 center border container_pad">
                    <form method="POST" action="{{ route('inventariodispositivos.store') }}">
                        @csrf

                        <div class=" row d-flex justify-content-center">
                            <div class="col-lg-3 col-sm-6">
                                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex align-items-center justify-content-center">
                                <h3 class="text-center text-primary">REGISTRO DE DISPOSITIVO</h3>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                <h4 style="color:red">Nro. </h4>                                
                            </div>
                        </div>

                        <div class="form-group row pt-5">
                            <label for="marca" class="col-md-1 col-form-label">
                                {{ __('Marca') }}
                            </label>    
                            <div class="col-md-3">
                                <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca">
                                @error('marca')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="modelo" class="col-md-1 col-form-label">
                                {{ __('Modelo') }}
                            </label>                    
                            <div class="col-md-2">
                                <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo">
                                @error('modelo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="num_serie" class="col-md-2 col-form-label">
                                {{ __('Numero de Serie') }}
                            </label>                    
                            <div class="col-md-3">
                                <input id="num_serie" type="text" class="form-control @error('num_serie') is-invalid @enderror" name="num_serie">
                                @error('num_serie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="tipo" class="col-md-1 col-form-label">
                                {{ __('Tipo') }}
                            </label>
                                    
                            <div class="col-md-3">
                                <input id="tipo" type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" required autocomplete="OFF">
                                @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                    
                            <label for="estado" class="col-md-1 col-form-label">
                                {{ __('Estado') }}
                            </label>                    
                            <div class="col-md-7">
                                <input id="estado" type="text" class="form-control @error('estado') is-invalid @enderror" name="estado">
                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                                <label for="caracteristicas" class="col-md-2 col-form-label">
                                    {{ __('Caracteristicas') }}
                                </label>                    
                                <div class="col-md-10">
                                    <input id="caracteristicas" type="text" class="form-control @error('caracteristicas') is-invalid @enderror" name="caracteristicas">
                                    @error('caracteristicas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!--div class="form-group row">
                                <label for="caracteristicas" class="col-md-2 col-form-label">
                                    {{ __('Ubicacion') }}
                                </label>                    
                                <div class="col-md-10">
                                    <input id="ubicacion" type="text" class="form-control @error('ubicacion') is-invalid @enderror" name="ubicacion">
                                    @error('ubicacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div-->
                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-md-10 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
</div>

@endsection
@section('mis_scripts')
<script>
</script>

@endsection