@extends('layouts.app')
@section('title', 'Inicio')
@section('content') 
<div class="wrapper">
  @include('layouts.lateralbar')
    <div class="container-fluid m-3 ancho_container"> 
          <div class="row pb-3">
            <div class="col"><h3>LIBRETAS DE FONDO FIJO <!--a href="{{ route('rendicionfondofijo.create') }}" >+</a--></h3></div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-sm table-bordered" >
             <thead>
                <th style="width: 30%">Unidad</th>
                <th>Fecha de Inicio</th>
                <th colspan="2" style="width: 15%;">Opciones</th>
             </thead>
             <tbody>
              @if($unidades->count())
              @foreach($unidades as $f)
              <tr>
                <td>{{$f->nombre}}</td>
                <td>{{$f->created_at}}</td>
                <td><a class="btn btn-primary btn-sm" href="{{action('RendicionFondoFijoController@edit', $f->id)}}" ><span class="glyphicon glyphicon-pencil">Detalle</span></a></td>
                <td>
                  <form action="{{action('RendicionFondoFijoController@destroy', $f->id)}}" method="post">
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
                            <button class="btn btn-danger" type="submit">Eliminar<span class="glyphicon glyphicon-trash"></span></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                 </td>
               </tr>
               @endforeach
               @else
               <tr>
                <td>No hay registro !!</td>
              </tr>
              @endif
            </tbody>
          </table>
          {{ $unidades->links() }}
        </div>
            
    </div>          
</div>
@endsection
