@extends('layouts.app')
@section('title', 'Inicio')
@section('static', 'statick-side')
@section('mi_estilo')
@endsection
@section('content') 
@include('layouts.sidebar', ['hide'=>'0']) 
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <table class="cell-border compact hover" id ="pcs" style="width:100%;font-size:0.7rem">
                <thead>
                    <th>ID</th>
                    <th>Equipo</th>
                    <th>Usuario</th>
                    <th>Unidad</th>
                    <th>Ubicacion</th>
                    <th>AD</th>
                    <th>IP</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @if($pcs->count())
                    
                        @foreach($pcs as $pc)
                        <tr>
                        <td>{{$pc->id}}</td>
                        <td>{{$pc->nombre}}</td>
                        @if($pc->perfil)
                            <td>{{$pc->perfil->nombre}} {{$pc->perfil->paterno}} {{$pc->perfil->materno}}</td>
                        @else
                            <td class="text-danger">Sin Asignar</td>
                        @endif
                        @if($pc->unidades)
                            <td>{{$pc->unidades->nombre}}</td>
                        @else
                            <td class="text-danger">Sin Asignar</td>
                        @endif
                        <td>{{$pc->ubicacion}}</td>
                        @if($pc->remoto->where('tipo', 'Anydesk')->first())
                        <td><a href="anydesk:{{$pc->remoto->where('tipo', 'Anydesk')->first()->acceso}}">{{$pc->remoto->where('tipo', 'Anydesk')->first()->acceso}}</a></td>
                        @else
                        <td>N/A</td>
                    @endif
                    <td>{{$pc->ip}}</td>
                    @switch($pc->tipo)
                        @case(1)
                            <td>De Escritorio</td>
                            @break
                        @case(2)
                            <td>Laptop</td>
                            @break
                        @case(2)
                            <td>Servidor</td>
                            @break
                        @default
                            <td class="text-danger">Sin Seleccionar</td>
                    @endswitch
                    @switch($pc->estado)
                        @case(1)
                            <td>Funcional</td>
                            @break
                        @case(2)
                            <td>En Mal Estado</td>
                            @break
                        @default
                            <td class="text-danger">Sin Seleccionar</td>
                    @endswitch
                    @if(Auth::user()->authorizepermisos(['Inventario PCs', 'Ver'])) 
                    <td>
                        <div style="display:flex;">
                            <div class="btn-group">
                            <a class="btn btn-outline-primary btn-sm" href="{{route('inventariosistemas.edit', $pc->id)}}" >
                                <span class="glyphicon glyphicon-pencil"><i class="fas fa-edit"></i></span></a>
                            <a class="btn btn-primary btn-sm" href="{{action('PcTransferController@edit', $pc->id)}}" >
                                <span class="glyphicon glyphicon-pencil"><i class="fas fa-random"></i></span></a>
                            </div>
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
                    <th>Equipo</th>
                    <th>Ubicacion</th>
                    <th>Usuario</th>
                    <th>AD</th>
                    <th>IP</th>
                    <th class="#N/A"></th>
                    <th class="#N/A"></th>
                    <th class="#N/A"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>            
</div>   
@endsection
@section('mis_scripts')
<script>  
$(document).ready(function() 
{  
    $('#pcs tfoot th').each( function () {
        if($(this).attr("class")!="#N/A")
        {
            var title = $(this).text();
            $(this).html( '<input type="text" class="form-control form-control-sm" placeholder="'+title+'" />' );
        }
    } );
    var table = $('#pcs').DataTable( 
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
        "columnDefs": [
            { "width": "6%", "targets": 0 }
        ],
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
        dom: 'Brtip',
        info: false,
        paging : false,
        buttons: 
        [                   
            {
                extend:'excel',
            }
        ],
    } );   
} );
</script>
@endsection