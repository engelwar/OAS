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
    <form method="POST" action="{{ route('inventariocelular.store') }}">
        @csrf

        <div class=" row d-flex justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
            </div>
            <div class="col-lg-9 col-sm-12 d-flex align-items-center justify-content-end">
                <h3 class="text-center text-primary">REGISTRO DE CELULARES</h3>
            </div>
        </div>

        <div class="form-group row pt-5 d-flex justify-content-center">
            <label for="imei" class="col-md-2 col-form-label">
                {{ __('IMEI') }}
            </label>    
            <div class="col-md-3">
                <input id="imei" type="text" class="form-control @error('imei') is-invalid @enderror" name="imei">
                @error('imei')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message}}</strong>
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
        <div class="form-group row d-flex justify-content-center">
            <label for="marca" class="col-md-2 col-form-label">
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

            <label for="modelo" class="col-md-2 col-form-label">
                {{ __('Modelo') }}
            </label>                    
            <div class="col-md-3">
                <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo">
                @error('modelo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                            
        </div>
        <div class="form-group row d-flex justify-content-center">
            <label for="nombre_comercial" class="col-md-2 col-form-label">
                {{ __('Nombre Comercial') }}
            </label>    
            <div class="col-md-3">
                <input id="nombre_comercial" type="text" class="form-control @error('nombre_comercial') is-invalid @enderror" name="nombre_comercial">
                @error('nombre_comercial')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message}}</strong>
                    </span>
                @enderror
            </div>

            <label for="color" class="col-md-2 col-form-label">
                {{ __('Color') }}
            </label>                    
            <div class="col-md-3">
                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color">
                @error('color')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                            
        </div>
        <div class="form-group row d-flex justify-content-center">
            <label for="pantalla" class="col-md-2 col-form-label">
                {{ __('Pantalla') }}
            </label>
                    
            <div class="col-md-3">
                <input id="pantalla" type="text" class="form-control @error('pantalla') is-invalid @enderror" name="pantalla" required autocomplete="OFF">
                @error('pantalla')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                    
            <label for="rom" class="col-md-2 col-form-label">
                {{ __('Memoria ROM') }}
            </label>                    
            <div class="col-md-3">
                <input id="rom" type="text" class="form-control @error('rom') is-invalid @enderror" name="rom">
                @error('rom')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                            
        </div>
        <div class="form-group row d-flex justify-content-center">
            <label for="cpu" class="col-md-2 col-form-label">
                {{ __('Procesador') }}
            </label>
                    
            <div class="col-md-3">
                <input id="cpu" type="text" class="form-control @error('cpu') is-invalid @enderror" name="cpu" required autocomplete="OFF">
                @error('cpu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                    
            <label for="ram" class="col-md-2 col-form-label">
                {{ __('Memoria RAM') }}
            </label>                    
            <div class="col-md-3">
                <input id="ram" type="text" class="form-control @error('ram') is-invalid @enderror" name="ram">
                @error('ram')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                            
        </div>
        <div class="form-group row d-flex justify-content-center">
            <label for="camara_principal" class="col-md-2 col-form-label">
                {{ __('Camara Principal') }}
            </label>
                    
            <div class="col-md-3">
                <input id="camara_principal" type="text" class="form-control @error('camara_principal') is-invalid @enderror" name="camara_principal" required autocomplete="OFF">
                @error('camara_principal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                    
            <label for="camara_frontal" class="col-md-2 col-form-label">
                {{ __('Camara Frontal') }}
            </label>                    
            <div class="col-md-3">
                <input id="camara_frontal" type="text" class="form-control @error('camara_frontal') is-invalid @enderror" name="camara_frontal">
                @error('camara_frontal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                            
        </div>
        <div class="form-group row d-flex justify-content-center">
            <label for="so" class="col-md-2 col-form-label">
                {{ __('Sistema Operativo') }}
            </label>
                    
            <div class="col-md-3">
                <input id="so" type="text" class="form-control @error('so') is-invalid @enderror" name="so" required autocomplete="OFF">
                @error('so')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                    
            <label for="bateria" class="col-md-2 col-form-label">
                {{ __('Bateria') }}
            </label>
                    
            <div class="col-md-3">
                <input id="bateria" type="text" class="form-control @error('bateria') is-invalid @enderror" name="bateria" required autocomplete="OFF">
                @error('bateria')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>         
        </div>
        <div class="form-group row d-flex justify-content-center">
            <label for="sd" class="col-md-2 col-form-label">
                {{ __('Ampliable SD') }}
            </label>  
            <div class="col-3 d-flex">
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="sd" id="sd" value="1">
                    <label class="form-check-label" for="inlineRadio1">SI</label>
                </div>     
                <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="sd" id="sd" value="0">
                    <label class="form-check-label" for="inlineRadio1">NO</label>
                </div>    
            </div> 
            <label for="cargador" class="col-md-2 col-form-label">
                {{ __('Cargador') }}
            </label>  
            <div class="col-3 d-flex">
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="cargador" id="cargador" value="TRUE">
                    <label class="form-check-label" for="inlineRadio1">SI</label>
                </div>     
                <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="cargador" id="cargador" value="0">
                    <label class="form-check-label" for="inlineRadio1">NO</label>
                </div>    
            </div>            
        </div>
        <div class="form-group row d-flex justify-content-center">
            <label for="cable_usb" class="col-md-2 col-form-label">
                {{ __('Cable USB') }}
            </label>  
            <div class="col-3 d-flex">
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="cable_usb" id="cable_usb" value="1">
                    <label class="form-check-label" for="inlineRadio1">SI</label>
                </div>     
                <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="cable_usb" id="cable_usb" value="0">
                    <label class="form-check-label" for="inlineRadio1">NO</label>
                </div>    
            </div> 
            <label for="audifonos" class="col-md-2 col-form-label">
                {{ __('Audifonos') }}
            </label>  
            <div class="col-3 d-flex">
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="audifonos" id="audifonos" value="1">
                    <label class="form-check-label" for="inlineRadio1">SI</label>
                </div>     
                <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="audifonos" id="audifonos" value="0">
                    <label class="form-check-label" for="inlineRadio1">NO</label>
                </div>    
            </div>            
        </div>
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