@extends('layouts.app')
@section('title', 'Inicio')
@section('mi_estilo')
<style>
  .file-upload {
    background-color: #ffffff;
    width: 600px;
    margin: 0 auto;
    padding: 20px;
  }

  .file-upload-content {
    display: none;
    text-align: center;
  }

  .file-upload-input {
    position: absolute;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    outline: none;
    opacity: 0;
    cursor: pointer;
  }

  .image-upload-wrap {
    margin-top: 20px;
    border: 4px dashed #355296;
    position: relative;
  }

  .image-dropping,
  .image-upload-wrap:hover {
    background-color: #355296;
    border: 4px dashed #ffffff;
    color: #fff;
  }

  .image-title-wrap {
    padding: 0 15px 15px 15px;
    color: #222;
  }

  .drag-text {
    text-align: center;
  }

  .drag-text h3 {
    font-weight: 100;
    text-transform: uppercase;
    padding: 60px 0;
  }

  .file-upload-image {
    max-height: 200px;
    max-width: 200px;
    margin: auto;
    padding: 20px;
  }

  .bg-adjud {
    background-color: coral;
  }

  .text-adjud {
    color: coral;
  }
  .tama{
    width: 30px;
    height: auto;
  }
</style>
@endsection
@section('content')
<!-- <meta http-equiv="refresh" content="3" /> -->
<div class="container border rounded col-12 p-3">
  <div class="row p-1">
    <div class="col-12 d-flex justify-content-center">
      <h3>SOLICITUD DE TICKET</h3>
    </div>
  </div>

<!--inicio-->
<form class="row g-3 needs-validation" novalidate>
  @csrf
  <div class="container">
    <div class="row justify-content-md">
      <div class="col col-lg-4">
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Usuario</span>
          <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{Auth::user()->perfiles->nombre}} {{Auth::user()->perfiles->paterno}} {{Auth::user()->perfiles->materno}}"disabled>
        </div>
      </div>
      <div class="col-md-auto">
        <div class="input-group mb-3">
          <select class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected disabled value="">Sucursal...</option>
            <option value="1">Casa Matriz</option>
            <option value="2">Ballivian</option>
            <option value="3">Calacoto</option>
            <option value="4">Handal</option>
            <option value="5">Mariscal</option>
            <option value="6">San Miguel</option>
            
          
          </select>
        </div>
      </div>
      <div class="col col-lg-6">
        <div class="input-group">
          <span class="input-group-text">Fecha del incidente</span>
          <input id="startDate" class="form-control" type="date" />
          <input type="time" class="form-control"  />
        </div>
      </div>
          </div>
    <div class="row">
      <div class="col col-lg-6">
        <div class="input-group">
          <span class="input-group-text">Descripcion</span>
          <textarea class="form-control" aria-label="With textarea"></textarea>
        </div>
      </div>
 
      <div class="col col-lg-6">
        <div class="input-group mb-3">
          <input type="file" class="form-control" id="inputGroupFile02">
          <label class="input-group-text" for="inputGroupFile02">Subir imagen </label>
        </div>
      </div>
      <div class="col col-lg-6">
        <div style="padding-top: 10px">
          <button type="button" class="btn btn-outline-secondary" >Enviar</button>
        </div>
      </div>
    </div>
  </div>
  </form>
<!--formulario end-->


  <form method="POST" action="{{ route('solicitudanuladas.store') }}">
    @csrf
    <div class="table-responsive text-center my-3">
      <table class="table table-bordered table-sm">
        <thead>
          <th style="width: 150px;">FechaDeEmision</th>
          <th style="width: 100px;">NroDeFactura/NotaRemision</th>
          <th style="width: 180px;">NombreDelCliente</th>
          <th style="width: 100px;">Importe</th>
          <th style="width: 100px;">MotivoDeAnulacion</th>
          <th style="width: 150px;">Usuario</th>
          <th style="width: 100px;"></th>
        </thead>
        <tbody>
          <tr>
            <td class="align-middle">
              <input type="date" id="fechaemision" name="fechaemision" style="width: 100%;" class="form-control form-control-sm @error('fechaemision') is-invalid @enderror" value="{{ old('fechaemision') }}" autocomplete="off">
              @error('fechaemision')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </td>
            <td class="align-middle">
              <input type="text" id="factura_remision" name="factura_remision" style="width: 100%;" class="form-control form-control-sm @error('factura_remision') is-invalid @enderror" value="{{ old('factura_remision') }}" autocomplete="off">
              @error('factura_remision')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </td>
            <td class="align-middle">
              <input type="text" id="cliente" name="cliente" style="width: 100%;" class="form-control form-control-sm @error('cliente') is-invalid @enderror" value="{{ old('cliente') }}" required autocomplete="cliente">
              @error('cliente')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </td>
            <td class="align-middle">
              <input type="text" id="importe" name="importe" style="width: 100%;" class="form-control form-control-sm @error('importe') is-invalid @enderror" value="{{ old('importe') }}" required autocomplete="importe">
              @error('importe')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </td>
            <td class="align-middle">
              <input type="text" id="motivo" name="motivo" style="width: 100%;" class="form-control form-control-sm @error('motivo') is-invalid @enderror" value="{{ old('motivo') }}" required autoomplete="motivo">
              @error('motivo')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </td>
            <td class="align-middle">{{Auth::user()->perfiles->nombre}} {{Auth::user()->perfiles->paterno}} {{Auth::user()->perfiles->materno}}</td>
            <td class="align-middle">
              <button type="submit" class="btn btn-danger">
                {{ __('Enviar') }}
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </form>
  <div class="row pt-5 border-primary" style="margin-top:70px; border-top: solid;">
    <div class="col-12 d-flex justify-content-center">
      <h3>SOLICITUDES</h3>
    </div>
  </div>
  <div class="row ">
    <div class="col d-flex justify-content-center">
      <p>
        Aceptado <span class="text-info"><i class="text-info  fas fa-check fa-lg"></i></span>
        - Rechazado <span class="text-danger"><i class="fa-lg text-danger fas fa-times"></i></span>
      </p>
    </div>
  </div>
  <div class="row pb-4">
    <div class="col">
    </div>
    <div class="col-3 col-sm-9 col-md-7 d-sm-flex justify-content-end">
      <form class="form-inline" action="{{action('CotizacionController@create')}}" method="GET">
        {{-- <input id="busca" name="busca" class="form-control col-4 col-sm-auto ml-auto" type="search" placeholder="Buscar Empresa" value="{{$busca}}" aria-label="Search"> --}}
        <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
      </form>
    </div>
    {{-- @if($busca!==NULL)
    <div class="col-1 d-flex justify-content-start">
      <form action="{{action('CotizacionController@create')}}" method="GET">
        <button class="form-control btn btn-primary" type="submit">x</button>
      </form>
    </div>
    @endif --}}
  </div>
 
    @endsection
    @section('mis_scripts')
    <!-- <script>
      //recarga segun el movimiento o pulsacion del tecledo contador en milisegundos  se mejoro 
      var time = new Date().getTime();
      $(document.body).bind("mousemove keypress", function(e) {
        time = new Date().getTime();
      });

      function refresh() {
        if (new Date().getTime() - time >= 3000)
          window.location.reload(true);
        else setTimeout(refresh, 3000);
      }
      setTimeout(refresh, 3000);
    </script> -->
    @endsection