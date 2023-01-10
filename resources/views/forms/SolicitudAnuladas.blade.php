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
</style>
@endsection
@section('content')
<!-- <meta http-equiv="refresh" content="3" /> -->
<div class="container border rounded col-12 p-3">
  <div class="row p-1">
    <div class="col-12 d-flex justify-content-center">
      <h3>SOLICITUD DE ANULACIONES</h3>
    </div>
  </div>
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
        <input id="busca" name="busca" class="form-control col-4 col-sm-auto ml-auto" type="search" placeholder="Buscar Empresa" value="{{$busca}}" aria-label="Search">
        <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
      </form>
    </div>
    @if($busca!==NULL)
    <div class="col-1 d-flex justify-content-start">
      <form action="{{action('CotizacionController@create')}}" method="GET">
        <button class="form-control btn btn-primary" type="submit">x</button>
      </form>
    </div>
    @endif
  </div>
  @if($cot->count())
  <div class="table-responsive text-center">
    <table class="table table-bordered table-sm">
      <thead class="bg-primary text-light">
        <th style="width: 130px;">FechaDeSolicitud</th>
        <th style="width: 100px;">FechaDeEmision</th>
        <th style="width: 120px;">NroFact/NR</th>
        <th style="width: 300px;">NombreDelCliente</th>
        <th style="width: 160px;">Importe</th>
        <th style="width: 330px;">MotivoDeAnulacion</th>
        <th style="width: 130px;">Usuario</th>
        <th style="width: 130px;">Estado</th>
      </thead>
      @foreach($cot as $co)
      <tbody>
        <tr>
          <td class="align-middle">{{date('d-M-Y',strtotime($co->created_at))}}</td>
          <td class="align-middle">{{date('d-M-Y',strtotime($co->fechaemision))}}</td>
          <!-- <td class="align-middle">{{date('h:s a',strtotime($co->fechaemision))}}</td> -->
          <td class="align-middle">{{$co->factura_remision}}</td>
          <td class="align-middle">{{$co->cliente}}</td>
          <td class="align-middle">{{$co->importe}}</td>
          <td class="align-middle">{{$co->motivo}}</td>
          <td class="align-middle">{{$co->user->perfiles->nombre}} {{$co->user->perfiles->paterno}} {{$co->user->perfiles->materno}}</td>
          <td class="align-middle">
            @if ($co->estado === null)
            @if (Auth::user()->tienePermiso(44,4))
            <form action="{{ route('solicitudanuladas.estado',$co->id) }}" method="get">
              <button value="0" class="btn btn-danger" type="submit" name="estado">Aceptar</button>
              <button value="9" class="btn" type="submit" name="estado">Rechazar</button>
            </form>
            @else
            En Espera
            @endif
            @elseif ($co->estado == 0)
            <span class="text-info"><i class="text-info  fas fa-check fa-lg"></i></span>
            @if (Auth::user()->tienePermiso(44,4))
            <form action="{{ route('solicitudanuladas.estado',$co->id) }}" method="get">
              <button value="" class="btn" type="submit" name="estado">Refrescar</button>
            </form>
            @endif
            @elseif ($co->estado == 9)
            <span class="text-danger"><i class="fa-lg text-danger fas fa-times"></i></span>
            @if (Auth::user()->tienePermiso(44,4))
            <form action="{{ route('solicitudanuladas.estado',$co->id) }}" method="get">
              <button value="" class="btn" type="submit" name="estado">Refrescar</button>
            </form>
            @endif
            @endif
          </td>
        </tr>
      </tbody>
      @endforeach
    </table>
  </div>
  @else
  <div class="text-center">Aun no hay Registro!!<div>
      @endif
      {{ $cot->links() }}
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