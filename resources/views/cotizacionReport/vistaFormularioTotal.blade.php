@extends('layouts.app')

<style>

table.dataTable {
  font-size: 0.9em;
}
.categoria_max
    {
        max-width: 300px !important;
        text-overflow: ellipsis;
    }
.intermitente{
  border: 1px solid red;
  padding: 20px 20px;
  box-shadow: 0px 0px 20px;
  animation: infinite resplandorAnimation 2s;
  
}
@keyframes resplandorAnimation {
  0%,100%{
    box-shadow: 0px 0px 20px;
  }
  50%{
  box-shadow: 0px 0px 0px;
  
  }

}
</style>

@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 
<!-- datos de tabla -->
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <table id="example" class="cell-border compact hover" style="width:100%">
           
            </table>        
        </div>
    </div>
</div>

@endsection

@section('mis_scripts')
<script>
var json_data = {!! json_encode($consultas) !!};

   
$(document).ready(function() 
{  
   
    var height = screen.height-500+'px';
    var table = $('#example').DataTable(
         
    {
    
        data: json_data,
        columns: [
            { data: 'Fecha', title: 'Fecha Cot' },
            
            { data: 'NroCotizacion', title: 'Nro Cot' },
        
            { data: 'Cliente', title: 'Cliente'},
            { data: 'FechaNR', title: 'Fecha NR'},
            { data: 'NR', title: 'NR'},
            { data: 'Totalventas', title: 'Total Ventas'},
            { data: 'Moneda', title: 'Moneda'},
            { data: 'Usuario', title: 'Usuario vendedor'},
            { data: 'Local', title: 'Local'},
            { data: 'FechaFac', title: 'Fecha fac'},
            { data: 'numerofactura', title: 'Nro Fac'},
            { data: 'estado', title: 'Estado'},
            
           
                   
        ],
        "pageLength": 100,  
        "columnDefs": [
            { className: "dt-right", "targets":[4,5,6]},
          
            { className: "categoria_max", "targets":[1,7]}
        ],
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
        "scrollX": false,
        "scrollY": height,
        "scrollCollapse": true, 
    } );
    //var sum = table.column(4).data().sum();
    //$("#sum").val(sum);
 
    setTimeout(function(){
    $(".page-wrapper").removeClass("toggled"); 
 }, 500);
} );
</script>
@endsection






