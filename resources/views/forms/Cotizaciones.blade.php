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
.bg-adjud
{
  background-color: coral;
}
.text-adjud
{
  color: coral;
}

</style>
@endsection
@section('content') 

    <div class="container border rounded col-12 p-3">

          <div class="row p-1">
            <div class="col-12 d-flex justify-content-center"><h3>REGISTRO DE COTIZACIONES</h3></div>
          </div>
              <form method="POST" action="{{ route('cotizacion.store') }}">
                @csrf
                <div class="table-responsive text-center my-3" >
                  <table class="table table-bordered table-sm" >
                 <thead>
                    <th style="width: 100px;">OV</th> 
                    <th style="width: 150px;">Nro. Licitacion</th> 
                    <th style="width: 100px;">NIT</th> 
                    <th style="width: 180px;">Empresa</th> 
                    <th style="width: 100px;">Unidad</th>
                    <th style="width: 100px;">Responsable de proceso</th>
                    <th style="width: 200px;">Nombre de Contacto</th>
                    <th>Telefono</th> 
                    <th style="width: 200px;">Cotizador</th>
                    <th>OPCIONES</th>
                 </thead>
                <tbody>
                  <tr>
                    <td class="align-middle">
                      <input type="text" id="OV" name="OV" style="width: 100%;" class="form-control form-control-sm @error('OV') is-invalid @enderror" value="{{ old('OV') }}" autocomplete="off">
                      @error('OV')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>
                    <td class="align-middle">
                      <input type="text" id="n_lic" name="n_lic" style="width: 100%;" class="form-control form-control-sm @error('n_lic') is-invalid @enderror" value="{{ old('n_lic') }}" autocomplete="off">
                      @error('n_lic')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>
                    <td class="align-middle">
                      <input type="text" id="nit" name="nit" style="width: 100%;" class="form-control form-control-sm @error('nit') is-invalid @enderror" value="{{ old('nit') }}" required autocomplete="nit">
                      @error('nit')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>
                    <td class="align-middle" >
                      <input type="text" id="empresa" name="empresa" style="width: 100%;" class="form-control form-control-sm @error('empresa') is-invalid @enderror" value="{{ old('empresa') }}" required autocomplete="empresa">
                      @error('empresa')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>
                    <td class="align-middle">
                      <input type="text" id="unid" name="unid" style="width: 100%;" class="form-control form-control-sm @error('unid') is-invalid @enderror" value="{{ old('unid') }}" required autoomplete="unid">
                      @error('unid')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>
                    <td class="align-middle">
                      <input type="text" id="nombre_resp" name="nombre_resp" style="width: 100%;" class="form-control form-control-sm @error('nombre_resp') is-invalid @enderror" value="{{ old('nombre_resp') }}" autoomplete="nombre_resp">
                      @error('nombre_resp')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>                    
                    <td class="align-middle">
                      <input type="text" id="nombre_contac" name="nombre_contac" style="width: 100%;" class="form-control form-control-sm @error('nombre_contac') is-invalid @enderror" value="{{ old('nombre_contac') }}" required autocomplete="nombre_contac">
                      @error('nombre_contac')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>
                    <td class="align-middle">
                      <input type="text" id="telf_contac" name="telf_contac" style="width: 100%;" class="form-control form-control-sm @error('telf_contac') is-invalid @enderror" value="{{ old('telf_contac') }}" autocomplete="telf_contac">
                      @error('telf_contac')
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
                  <tr>
                  <td></td>
                  <th class="align-middle">Descripcion</th>
                  
                    <td class="align-middle" colspan="3">
                        <textarea type="text" id="descrip" name="descrip" rows="5" cols="80" class="form-control @error('descrip') is-invalid @enderror" required autocomplete="descrip">
                        {{ old('descrip') }}
                        </textarea>
                        @error('descrip')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </td>
                  </tr>
                 </tbody>
                </table>
              </div>
    
              </form>

          <div class="row pt-5 border-primary" style="margin-top:70px; border-top: solid;">
            <div class="col-12 d-flex justify-content-center"><h3>COTIZACIONES</h3></div>
          </div>
          <div class="row ">
            <div class="col d-flex justify-content-center">
              <p>
                Seguimiento <span  class="text-info"><i class="text-info  fas fa-check fa-lg"></i></span> 
                - Rechazado <span class="text-danger"><i class="fa-lg text-danger fas fa-times"></i></span> 
                - Adjudicado <span><i class="fa-lg text-adjud fas fa-handshake"></i></span>
                - Parcial <span class="text-warning"><i class="fas fa-star-half text-success fa-lg"></i></span>
                - Completa <span class="text-success"><i class="fas fa-star text-success fa-lg"></i></span>
              </p>
            </div>
          </div>


          <div class="row pb-4">
            <div class="col">
            </div>
            <div class="col-3 col-sm-9 col-md-7 d-sm-flex justify-content-end">
                <form class="form-inline" action="{{action('CotizacionController@create')}}" method="GET">
                  <input id="busca" name="busca" class="form-control col-4 col-sm-auto ml-auto"type="search" placeholder="Buscar Empresa" value ="{{$busca}}" aria-label="Search">
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
          <div class="table-responsive text-center" >
            <table class="table table-bordered table-sm">

             <thead class="bg-primary text-light">
                <th style="width: 130px; ">Fecha</th>
                <th style="width: 100px;">Hora</th>
                <th style="width: 150px;">NIT</th> 
                <th style="width: 300px;">Empresa</th> 
                <th style="width: 160px;">Unidad</th>
                <th style="width: 330px;" >Descripcion</th>
                
                <th style="width: 130px;">Cotizador</th>
                <th style="width: 30px;">S</th>
                <th style="width: 30px;">E</th>
                <th style="min-width: 120px; max-width: 120px;" colspan="3">OPC</th>
             </thead>
              @foreach($cot as $co)
              <tbody>
              <tr >
                <td class="align-middle">{{date('d-M-Y',strtotime($co->created_at))}}</td>
                <td class="align-middle">{{date('h:s a',strtotime($co->created_at))}}</td>
                <td class="align-middle">{{$co->nit}}</td>
                <td class="align-middle">{{$co->empresa}}</td>
                <td class="align-middle">{{$co->unid}}</td>
                <td class="align-middle" style="max-width: 330px;overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;">
                   {{$co->descrip}}
                </td>                     
                <td class="align-middle">{{$co->user->perfiles->nombre}}</td>  
                <td class="align-middle">
                  @if($co->estados->where('estado', 'Seguimiento')->first())
                    <i class="fa-lg text-info  fas fa-check"></i> 
                  @endif
                </td>
                <td class="align-middle">
                  @if($co->estados->where('estado', 'Adjudicado')->first())
                    @if($co->estados->where('estado', 'Parcial')->first())
                      @if($co->estados->where('estado', 'Total')->first())
                        <i class="fas fa-star text-success fa-lg"></i>
                      @else 
                        <i class="fa-lg fas fa-star-half text-success"></i>
                      @endif
                    @elseif($co->estados->where('estado', 'Total')->first())
                      <i class="fas fa-star text-success fa-lg"></i>
                    @else
                      <i class="fa-lg text-adjud fas fa-handshake"></i>
                    @endif
                  @elseif($co->estados->where('estado', 'Rechazado')->first())
                    <i class="fa-lg text-danger fas fa-times"></i>
                  @else

                  @endif
                </td>
                <td class="align-middle" style="min-width: 20px; max-width: 20px;" >
                  <a href="{{action('CotizacionController@edit', $co->id)}}" >
                    <span><i class="fas fa-search"></i></span>
                  </a>
                </td>
              
                <td class="align-middle" style="min-width: 40px; max-width: 40px;">
                @if(Auth::user()->id==$co->user_id)
                <button type="button" class="btn" data-toggle="modal" data-target="#no_{{$co->id}}">
                <i class="fas fa-upload"></i>
                </button>
                @endif

                <!-- Modal NO COMPLETADO-->
                <div class="modal fade" id="no_{{$co->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Subir Archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" enctype="multipart/form-data" action="{{ route('cotizacion.upload' , $co->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="PATCH">
                      <div class="modal-body">

                          <div class="row">
                          <div class="file-upload col">
                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept=".pdf" id="coti" name="coti"/>
                              <div class="drag-text">
                                <h3>Click para agregar archivo</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <span class="image-title">Uploaded Image</span>
                            </div>
                          </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Aceptar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                </td>

                  <td class="align-middle" style="min-width: 40px; max-width: 40px;">
                    
                  <button type="button" class="btn @if(count($scans = $co->scans()->get())) text-success @endif" data-toggle="modal" data-target="#down_{{$co->id}}">
                  <i class="fas fa-download"></i>
                  </button>

                  <!-- Modal NO COMPLETADO-->
                  <div class="modal fade" id="down_{{$co->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Descargar Archivo</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                            
                              @if(count($scans = $co->scans()->get()))
                                @foreach($scans as $s)
                                <div class="row">
                                <div class="col-6">
                                <form method="POST" action="{{ route('cotizacion.download' , $s->id) }}">
                                        @csrf
                                      <button type="submit" class="btn">
                                        {{$s->name}}<i class="fas fa-download"></i>
                                      </button>
                                    </form>
                                </div>
                                </div>
                                @endforeach
                              @else
                                  <div class="row">
                                    <div class="col p-5">
                                    Aun no se subio ningun archivo
                                    </div>
                                  </div>
                              @endif
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
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
<script>
function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}
</script>
@endsection
