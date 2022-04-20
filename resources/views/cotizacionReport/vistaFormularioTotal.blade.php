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
        <div class="col-md-12">
            
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
                <form method="POST" action="{{'v/s'}}">
                    @csrf
               
                <div class="mb-2">
                  <input type="hidden" id="name1" name="id_cotizacion" required minlength="4" maxlength="8" size="20" value="text">
                  <input type="hidden" id="name2" name="iduser" maxlength="8" size="10" value="{{Auth::user()->id}}">
                  <br>
                  <label for="message-text" class="col-form-label">Escriba la observacion:</label>
                  <textarea class="form-control" id="message-text" name="comentario"></textarea>
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

      <!-- boton modal 2 -->


      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
      </svg>



<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">OBSERVACION</h5>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
       
        <form method="POST" action="">
         
          @csrf @method('PUT')
          <input type="hidden" id="name2" name="iduser" maxlength="8" size="10" value="{{Auth::user()->id}}">
          <div class="mb-3">
            {{$cotizacion_report->id}}
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                      La observacion solo se puede cambiar dos veces
                </div>
              </div>
              <input type="hidden" id="name1" name="nr" required minlength="4" maxlength="8" size="20" value="text">
                  <input type="hidden" id="name2" name="id_user" maxlength="8" size="10" value="{{Auth::user()->id}}">
            
               <!--insertar datos para la consulta -->
               <div class="input-group">
                <span class="input-group-text">Observacion anterior</span>
                <textarea class="form-control" aria-label="With textarea" id="et1" name="et1" disabled ></textarea>
              </div>
            </div>
          <div class="mb-4">
            <label for="message-text" class="col-form-label" >Observacion a modificar.</label>
            

            <textarea class="form-control  text-aling-center" id="message-text" name="comentario"></textarea>
          </div>
      
       <span>  Usuario: {{auth()->user()->perfiles->nombre}} {{auth()->user()->perfiles->paterno}} {{auth()->user()->perfiles->materno}}</span>
       <br>
     <!--añadir numero modificaciones-->
       <span>Numero de modificaciones hechas en total: <input type="number" id="name1" name="numero" required minlength="1" maxlength="5" size="5" value="0" disabled></span>
       <div class="modal-footer">
        <!--controlador de  botones -->  
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        @if (1===1)
        <button type="submit" class="btn btn-outline-danger">Modificar</button>
        @else
        <button type="button" class="btn btn-outline-danger" disabled>Limite excedido</button> 
        @endif
      
      </div>
    </div>
      </form>
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
var json_data2 = {!! json_encode($observacionBD) !!};
var ids=[];
let contar=0;

   
$(document).ready(function() 
{      
    var height = screen.height-380+'px';
    var dd1=1;
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
            {
        "data": null,
        "bSortable": false,
        "mRender": function(data, type, value) {
          var status = '<div style="text-align: right;width:90px"> <button type="button"  id='+value["NR"]+' onclick="obtenerId(this.id)" class="btn btn-outline-secondary btnHT '+value["active"]+'" axn='+value["active"]+' idc='+value["NR"]+' data-bs-toggle="modal" data-bs-target="#exampleModal99"  data-bs-whatever="@mdo"><span><i class="fa fa-exclamation-triangle"></i></span></button> <a type="button"  id='+value["NR"]+'0001'+'  class="btn btn-outline-secondary btnEdit '+value["active"]+'" axn='+value["active"]+' idc='+value["NR"]+' data-bs-toggle="modal" data-bs-target="#exampleModal12"  data-bs-whatever="@mdo" onclick="editar(this.id)"><span><i class="fa fa-search"></i></span></a></div>';
          
          return status;}, title :'OBS'
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
var fila; //capturar la fila para editar
    
//botón EDITAR    
function editar(id){
  idx="#"+id;
  $(idx).click(function(){
  $("#exampleModal2").modal("show");
})
var fila;
$(document).on("click",".btnEdit", function(){
  fila=$(this).closest("tr");
  
  ids=parseInt(fila.find('td:eq(4)').text());
  $("#name1").val(id);
}); 
}



function myFunction() {
  window.open("CotizacionReporte.update",'','widght=400, height=600');
}








</script>
@endsection






