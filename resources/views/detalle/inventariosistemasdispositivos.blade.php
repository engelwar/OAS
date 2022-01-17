@extends('layouts.app')
@section('title', 'Inicio')
@section('content') 
<div class="wrapper">
    <div class="container-fluid p-4 ancho_container"> 
        <div class="row">
            <div class="col-12"><h3>Dispositivos</h3></div>
        </div>
        <div class="row pb-4">
            <div class="col">
                <a href="{{ route('usuario.create') }}" class="btn btn-primary" >Añadir</a>
            </div>
            <div class="col-10 col-sm-9 col-md-7 d-sm-flex justify-content-end">
                <form class="form-inline" action="{{action('UsuarioController@index')}}" method="GET">
                <select class="form-control mr-sm-2 col-5 col-sm-auto" id="buscar" name="buscar">
                    <option value="1">Nombre</option>
                    <option value="2">CI</option>
                </select>
                <input id="busca" name="busca" class="form-control col-4 col-sm-auto ml-auto"type="search" placeholder="Buscar" aria-label="Search">
                <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
                </form>
            </div>
        </div>
          <div class="table-responsive" >
            <table class="table table-sm table-bordered table-hover" >
             <thead>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Caracteristicas</th>
                <th colspan="2">Opciones</th>
             </thead>
             <tbody>
              @if($disp->count())
              @foreach($disp as $dis)
              <tr>
                <td>{{$dis->tipo}}</td>
                <td>{{$dis->marca}}</td>
                <td>{{$dis->modelo}}</td>
                <td>{{$dis->estado}}</td>
                <td>{{$dis->caracteristicas}}</td>
                @if(Auth::user()->authorizepermisos(['edit_users'])) 
                <td style="width: 100px;">
                    <div style="display: flex;">
                    <a class="btn btn-primary btn-sm" href="{{action('InventarioSistemasController@edit', $dis->id)}}" ><span class="glyphicon glyphicon-pencil">Detalle</span></a>
                    <form action="{{action('UsuarioController@destroy', $dis->id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="button" disabled class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Eliminar
                        </button>
                        <div class="modal fade text-dark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminacion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Esta Seguro de Eliminar La informacion de este Cliente?
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger btn-xs" type="submit">Eliminar<span class="glyphicon glyphicon-trash"></span></button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                 </td>
                 @endif
               </tr>
               @endforeach
               @else
               <tr>
                <td>No hay registro !!</td>
              </tr>
              @endif
            </tbody>
          </table>
          {{ $disp->links() }}
        </div>
            
    </div>          
</div>
@endsection