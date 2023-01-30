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


  .contain-tab {
    /* display: flex;
    align-items: center;
    justify-content: center; */
    min-height: 100vh;
    background-color: #d4e6f4;
  }

  .tab-container {
    /* width: 600px;
    height: 400px;
    box-shadow: 3px 5px 10px rgba(0, 0, 0, .8); */
    border-radius: 5px;
    overflow: hidden;
  }

  .options {
    display: flex;
    width: 100%;
    height: 15%;
    list-style: none;
    padding-left: 0px;
  }

  .option {
    flex-grow: 1;
    text-align: center;
    line-height: 60px;
    border: solid 1px rgba(4, 51, 78, .6);
    color: black;
    cursor: pointer;
  }

  .option-active {
    background: #a3d7ff;
    border-bottom: 1px solid rgba(7, 63, 95, .4);
  }

  .content {
    width: 100%;
    height: 100%;
    color: black;
    display: none;
    padding: 20px;
  }

  .content-active {
    background-color: #fff;
    display: block;
  }
</style>
@endsection
@section('content')
<!-- <meta http-equiv="refresh" content="3" /> -->
<div class="container border rounded col-12 p-3">
  <div id="seccion1">
    <div class="contain-tab">
      <div class="tab-container">
        <ul class="options">
          <li id="option1" class="option option-active">Anulacion</li>
          <li id="option2" class="option">Cliente</li>
          <li id="option3" class="option">Producto</li>
        </ul>
        <div class="contents">
          <div id="content1" class="content content-active container border rounded col-12 p-3">
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
                  <th style="width: 130px;">FechaModificacion</th>
                </thead>
                @foreach($cot as $co)
                <tbody>
                  <tr>
                    <td class="align-middle">{{date('d-M-Y',strtotime($co->created_at))}}<br>{{date('h:s a',strtotime($co->created_at))}}</td>
                    <td class="align-middle">{{date('d-M-Y',strtotime($co->fechaemision))}}</td>
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
                    <td class="align-middle">{{date('d-M-Y',strtotime($co->updated_at))}}<br>{{date('h:s a',strtotime($co->updated_at))}}</td>
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
            </div>
          </div>
          <div id="content2" class="content container border rounded col-12 p-3">
            <div class="row p-1">
              <div class="col-12 d-flex justify-content-center">
                <h3>SOLICITUD DE CREACION DE CLIENTE</h3>
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
                  <th style="width: 130px;">FechaModificacion</th>
                </thead>
                @foreach($cot as $co)
                <tbody>
                  <tr>
                    <td class="align-middle">{{date('d-M-Y',strtotime($co->created_at))}}<br>{{date('h:s a',strtotime($co->created_at))}}</td>
                    <td class="align-middle">{{date('d-M-Y',strtotime($co->fechaemision))}}</td>
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
                    <td class="align-middle">{{date('d-M-Y',strtotime($co->updated_at))}}<br>{{date('h:s a',strtotime($co->updated_at))}}</td>
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
            </div>
          </div>
          <div id="content3" class="content container border rounded col-12 p-3">
            <h3>Option 3</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi, aspernatur? Est labore, obcaecati deserunt veritatis commodi molestias cumque deleniti. Quod, pariatur recusandae! Quis beatae dolore repellendus eveniet error fuga porro quas laudantium itaque voluptatibus quia dignissimos corporis cumque quam accusantium omnis expedita reiciendis, deleniti dolorum nihil aliquid quaerat consequatur ipsa!</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('mis_scripts')
<script>
  const option1 = document.getElementById('option1');
  const option2 = document.getElementById('option2');
  const option3 = document.getElementById('option3');
  const content1 = document.getElementById('content1');
  const content2 = document.getElementById('content2');
  const content3 = document.getElementById('content3');

  let chose = 1;

  const changeOption = () => {
    chose == 1 ? (
      option1.classList.value = 'option option-active',
      content1.classList.value = 'content content-active container border rounded col-12 p-3'
    ) : (
      option1.classList.value = 'option',
      content1.classList.value = 'content container border rounded col-12 p-3'
    )

    chose == 2 ? (
      option2.classList.value = 'option option-active',
      content2.classList.value = 'content content-active container border rounded col-12 p-3'
    ) : (
      option2.classList.value = 'option',
      content2.classList.value = 'content container border rounded col-12 p-3'
    )

    chose == 3 ? (
      option3.classList.value = 'option option-active',
      content3.classList.value = 'content content-active container border rounded col-12 p-3'
    ) : (
      option3.classList.value = 'option',
      content3.classList.value = 'content container border rounded col-12 p-3'
    )
  }

  option1.addEventListener('click', () => {
    chose = 1
    changeOption()
  });
  option2.addEventListener('click', () => {
    chose = 2
    changeOption()
  });
  option3.addEventListener('click', () => {
    chose = 3
    changeOption()
  });
</script>
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