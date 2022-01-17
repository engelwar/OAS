@extends('layouts.app')
@section('title', 'Inicio')
@section('mi_estilo')
 <style>
   
 </style>
@endsection
@section('content') 
    <div class="row d-flex justify-content-center py-4 w-100">
    <div class="container border rounded col-12 bg-light p-4"> 
        @if(Auth::user()->authorizePermisos(['materialfaltante_p_form']))   
          <div class="row p-2 ">
            <div class="col-12 d-flex justify-content-center">
              <h3>SOLICITUD DE MATERIAL</h3>
            </div>
          </div>

          <div class="row border-primary d-flex justify-content-center" style="border-bottom: solid;">
            <div class="col-11">
              <form method="POST" action="{{ route('materialfaltante.store') }}">
                @csrf
                <div class="table-responsive text-center my-4" >
                  <table class="table table-bordered table-sm" >
                    <thead>
                      <th style="width: 130px;">Codigo</th> 
                      <th style="width:300px">Material Faltante</th> 
                      <th style="width:80px">Cantidad</th> 
                      <th style="width:300px">Comentario</th> 
                      <th style="width: 180px;">Estado</th> 
                      <th colspan="2">Opciones</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="align-middle" >
                          <input type="text" id="codigo" name="codigo" class="form-control @error('codigo') is-invalid @enderror">
                          @error('codigo')
                            <span class="invalid-feedback" role="alert">
                              <strong>Ingresar el codigo es necesario.</strong>
                            </span>
                          @enderror
                        </td>
                        <td class="align-middle" >
                          <input type="text" id="material" name="material" class="w-100 form-control @error('material') is-invalid @enderror" required>
                          @error('material')
                            <span class="invalid-feedback" role="alert">
                              <strong>Ingresar el material es necesario</strong>
                            </span>
                          @enderror
                        </td>
                        <td class="align-middle" >
                          <input type="text" id="cantidad" name="cantidad" class="w-100 form-control @error('cantidad') is-invalid @enderror">
                          @error('cantidad')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                          @enderror
                        </td>
                        <td class="align-middle" >
                          <input type="text" id="coment" name="coment" class="w-100 form-control @error('coment') is-invalid @enderror" required>
                          @error('coment')
                            <span class="invalid-feedback" role="alert">
                              <strong>Ingresar el comentario es necesario</strong>
                            </span>
                          @enderror
                        </td>
                        <td class="align-middle" >
                          <select id="motivo" name="motivo" class="w-100 form-control">
                            <option value="Quiebre de Stock" selected>Quiebre de Stock</option> 
                            <option value="Solicitud de Tienda">Solicitud de Tienda</option>
                            <option value="Solicitud de Almacen">Solicitud de Almacen</option>
                          </select>
                        </td>
                        <td class="align-middle" style="width: 20px;" >                          
                              <button type="submit" class="btn btn-danger">
                                {{ __('Solicitar') }}
                              </button>
                        </td>                                                                       
                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
          @endif
          <div class="row" style="margin-top:70px;">
            <div class="col-12 d-flex justify-content-center"><h3>MATERIAL SOLICITADO</h3></div>
          </div>

          <div class="row ">
            <div class="col d-flex justify-content-center">
              <p>
                Faltante <span style="font-size: 1.5rem;color:coral;">■</span> 
                - Peticion Cancelada <span style="font-size: 1.5rem; color:cornflowerblue" >■</span>
                
                - Perdido en Proceso<span style="font-size: 1.5rem; color:paleturquoise" >■</span>
                - Entrega Parcial <span style="font-size: 1.5rem;color:gold">■</span>  
                - Entrega Completa <span style="font-size: 1.5rem;" class="text-success">■</span>
                - imposibilidad de entrega <span style="font-size: 1.5rem;" class="text-danger">■</span>
              </p>
            </div>
          </div>
          <div class="row pb-4">
            <div class="col">
            </div>
            <div class="col-3">
              <form class="form-inline" action="{{action('MaterialFaltanteController@create')}}" method="GET">
                  <input id="busca" name="busca" class="form-control col-4 col-sm-auto ml-auto"type="search" placeholder="Buscar" @if($busca!==NULL) value="{{$busca}}" @endif aria-label="Search">
                  <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
                </form>
                
              </div>
              @if($busca!==NULL)
                <div class="col-1 d-flex justify-content-start">
                  <form action="{{action('PlanificacionController@create')}}" method="GET">
                      <button class="form-control btn btn-primary" type="submit">x</button>
                  </form>
                </div>
               @endif
          </div>
          {{ $mate->links() }}  
          @if($mate->count())
          <div class="table-responsive text-center" >
            <table class="table table-bordered table-sm">

             <thead class="bg-primary text-light">
              <th style="width: 50px;">Codigo</th> 
                <th style="width: 350px;">Material</th> 
                <th style="width: 25px;">Cantidad</th>
                <th style="width: 100px;">Usuario</th>
                <th style="width: 100px;">Fecha</th>
                <th style="max-width: 35px;">E</th>
                <th style="width: 20px;">OPC</th>
             </thead>
              @foreach($mate as $m)
              <tbody>
              <tr >
                <td class="align-middle">{{$m->codigo}}</td>
                <td class="align-middle">{{$m->material}} </td>
                <td class="align-middle">{{$m->cantidad}}</td>
                <td class="align-middle">{{$m->user->nombre}} {{$m->user->paterno}}</td>
                <td class="align-middle">{{$m->created_at}}</td>
                <td class="
                  @if(!count($m->estados()->get()))
                    bg-coral
                  @endif
                  @if($m->estados->where('estado', 'NoConseguido')->first())
                    bg-danger
                  @endif
                  @if($m->estados->where('estado', 'Cancelado')->first())
                    bg-cornflowerblue
                  @endif
                  @if($m->estados->where('estado', 'EnProceso')->first())                    
                    @if($m->estados->where('estado', 'Total')->first())
                      bg-success
                    @endif
                    @if($m->estados->where('estado', 'Parcial')->first())
                      bg-gold
                    @endif   
                    @if(!$m->estados->where('estado', 'Total')->first()&&!$m->estados->where('estado', 'Parcial')->first())
                      bg-paleturquoise  
                    @endif                 
                  @endif
                  
                  "style="width: 30px;"></td>
                <td class="align-middle">
                  <a href="{{action('MaterialFaltanteController@edit', $m->id)}}" >
                    <span><i class="fas fa-search"></i></span>
                    </a>
                </td>
               </tr>
              </tbody>
               @endforeach
                
              
            
          </table>
          </div>
          @else
              <div class="text-center">Aun no hay Registro!!<div>
          @endif
          {{ $mate->links() }}  
    </div>          
  </div>
@endsection
@section('mis_scripts')
<script>
  $(function () {
    $('#imprev').tooltip()
  })
</script>
@endsection
