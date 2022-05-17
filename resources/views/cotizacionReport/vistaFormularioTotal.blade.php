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

<div class="container-fluid">
 
  
    <div class="row justify-content-center mt-4">
      <div style="text-align: center"> <h4>REPORTE COTIZACION</h4> </div>
   
      <div class="col-md-12">
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
            <table id="example" class="cell-border compact hover" style="width:100%">
               
            </table>        
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Observacion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('CotizacionReporte.crearZ')}}">
                 
                        @csrf

                 
               
                <div class="mb-2">
                  <input type="hidden" id="name1" name="id_cotizacion" required minlength="4" maxlength="8" size="20" value="text">
                  <input type="hidden" id="name2" name="iduser" maxlength="8" size="10" value="{{Auth::user()->id}}">
                  <br>
                  <label for="message-text" class="col-form-label">Escriba la observacion:</label>
                  <textarea class="form-control" id="message-text" name="comentario" required ></textarea>
                </div>
                <span>Usuario: {{auth()->user()->perfiles->nombre}} {{auth()->user()->perfiles->paterno}} {{auth()->user()->perfiles->materno}}</span>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              
              
           
              <button type="sumit" class="btn btn-primary btnEditar" >Enviar observacion</button>
            </div>
        </form>
        </div>
          </div>
        </div>
      </div>

    





<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">OBSERVACION</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        No se hizo ningun comentario...... 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



</div>


@endsection

@section('mis_scripts')
<script>
var json_data = {!! json_encode($consultas) !!};
var json_data2 = {!! json_encode($estadoF) !!};
var ids=[];
let contar=0;

   
$(document).ready(function() 
{      
    var height = screen.height-380+'px';
    var dd1=0;
    var table = $('#example').DataTable(
        
    {
        data2: json_data2,
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
<<<<<<< HEAD
         
            { data: "NR",
    render: function (data, type, row,$estadoF) {
     
=======
       /*     
          { data: null,
          render: function (data, type, row) {
          
            if (data.NR ==="1010159058") {
            return '<span  class="text-info"><i class="text-info  fas fa-check fa-lg"></i> </span>';
            //return ' @foreach ($estadoF as $i) @if($i->estado=="Seguimiento"&&$i->cotizacion_form_id==1010117123)'+data+' @break  @endif @endforeach ';
      }          
>>>>>>> eb117a0bd5592af9a05c44ae98d56d9cafad4883
     },title: 'S'},

            {"data":null,
            "bSortable":null,
            "mRender":function(data,type,value){
              
              return '@foreach ( $estadoF as $i)@if ($i->cotizacion_form_id=="1010159058") <p>{{$i->cotizacion_form_id}}</p> @break  @endif @endforeach';
            },title: 'E'},
           */
            {
        "data": null,
        "bSortable": false,
        "mRender": function(data, type, value) {
          var status = ' <button type="button"  id='+value["NR"]+' onclick="obtenerId(this.id)" class="btn btn-outline-secondary btnHT '+value["active"]+'" axn='+value["active"]+' idc='+value["NR"]+' data-bs-toggle="modal" data-bs-target="#exampleModal99"  data-bs-whatever="@mdo"><span><i class="fa fa-exclamation-triangle"></i></span></button> ';
          
          return status;}, title :'OBS'
       },
       
             {
        "data": null,
        "bSortable": false,
        
        "mRender": function(data, type, value) {
        
          
          var status ='<a type="button" href="v/'+value["NR"]+'/edit" class="external" id='+value["NR"]+'0001'+'  class="btn btn-outline-secondary btnEdit '+value["active"]+'" axn='+value["active"]+' idc='+value["NR"]+' data-bs-toggle="modal" data-bs-target="#exampleModal12"  data-bs-whatever="@mdo"><span><i class="fa fa-search"></i></span></a>';
            return status;}, title :'S/E'
       },
    
     
    
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

  
/*
    $(function() {
 $(document).on('click', 'input[type="button"]', function(event) {
    let id = this.id;
	console.log("Se presionó el Boton con Id :"+ id)
  });
});
*/

    setTimeout(function(){
    $(".page-wrapper").removeClass("toggled"); 
 }, 500);
} );
//=== obtiene el id y manda a otra ventana
function obtenerId(id){
  idx="#"+id;
  $(idx).click(function(){
    
  $("#exampleModal").modal("show");
});
var fila;
$(document).on("click",".btnHT", function(){
  fila=$(this).closest("tr");
  ids=parseInt(fila.find('td:eq(4)').text());
  $("#name1").val(id);
}); 

  //alert(id);
}

  


//botón EDITAR    
function editar(id){
  idx="#"+id;

  $(document).ready(function(){
   $("a.btnEdit").click(function() {
      url = $(this).attr("href");
      window.open(url, '_blank');
      return false;
   });
});

}



$(document).ready(function(){
   $("a.external").click(function() {
      url = $(this).attr("href");
      window.open(url, '_blank');
      return false;
   });
});








</script>
@endsection






