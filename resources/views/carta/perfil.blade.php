@extends('layouts.app')
@section('static', 'statick-side')
@section('content') 
@include('layouts.sidebar', ['hide'=>'1']) 
    <div class="container">    
          <div class="row my-3">
            <div class="col">
         
            </div>
          </div>
          <table class="cell-border compact hover" id="example" style="width:100%;" >
            <thead>
        
             
              <th>Observacion</th>
              <th>Estado</th>
              <th>Accion</th>

            
            </thead>
            <tbody>
          
            <tr>
              <td>0</td>
              <td>0</td>
              <td>0</td>

              </tr>
       
           
         
          </tbody>
   
        </table>        
    </div>          
@endsection
@section('mis_scripts')
<script>
$(document).ready(function() 
{  
    
    var table = $('#example').DataTable( 
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
        "columnDefs": [
            { width:"10%", "targets": 3 }
        ],
        "pageLength": 50,
        "scrollX":true,
        "scrollY": "60vh",
        "scrollCollapse": true, 
        "FixedHeader":true,
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
        }
    } );
} );

</script>
@endsection