@extends('layouts.app')
@section('title', 'Inicio')
@section('static', 'statick-side')
@section('content')
@include('layouts.sidebar', ['hide'=>'1']) 
    <div class="container-fluid pt-4" style="display:block;"> 
            <div class="row pb-2 justify-content-between">
                <div class="col-3">
                    <h3>Dispositivos
                    <a href="{{ route('dispositivos.create') }}"  >+</a></h3>
                </div>
            </div>    
            <table class="cell-border compact hover" id ="disp" style="width:100%;">
             <thead>
                 <th>id</th>
                <th>Tipo</th>
                <th>Caracteristicas</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>PC</th>
                <th>Opciones</th>
             </thead>
             <tbody>
              @if($disp->count())
              @foreach($disp as $dis)
              <tr>
                <td>{{$dis->id}}</td>
                <td>{{$dis->tipo}}</td>
                <td>{{$dis->caracteristicas}}</td>
                <td>{{$dis->marca}}</td>
                <td>{{$dis->modelo}}</td>
                <td>{{$dis->num_serie}}</td>
                @if($dis->pc)
                <td>{{$dis->pc->nombre}}</td>
                @else
                <td>No Asignada</td>
                @endif
                @if(Auth::user()->authorizepermisos(['Dispositivos', 'Ver'])) 
                <td>
                    <div style="display: flex;">
                    <a class="btn btn-primary btn-sm" href="{{route('dispositivos.edit', $dis->id)}}" ><span class="glyphicon glyphicon-pencil"><i class="fas fa-edit"></i></span></a>
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
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Caracteristicas</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>PC</th>
                <th class="#N/A"></th>
              </tr>
            </tfoot>
          </table>            
    </div>          
@endsection
@section('mis_scripts')
<script>
$(document).ready(function() 
{  
    $('#disp tfoot th').each( function () {
        if($(this).attr("class")!="#N/A")
        {
          var title = $(this).text();
          $(this).html( '<input type="text" class="form-control form-control-sm" placeholder="'+title+'" />' );
        }
    } );
    $('#disp').DataTable( 
    {
        "language":             
        {
            "emptyTable":     "Tabla Vacia",
            "info":           "Se muestran del _START_ al _END_ de _TOTAL_ registros",
            "infoEmpty":      "Se muestran del 0 al 0 de 0 Registros",
            "infoFiltered":   "(Filtrado de un total de _MAX_ registros)",
            "lengthMenu":     "Se muestran _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontro ningun registro",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        "pageLength": 100,
        "scrollX": true,
        "scrollY": "65vh",
        "scrollCollapse": true, 
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        },
    } );
} );
</script>
@endsection