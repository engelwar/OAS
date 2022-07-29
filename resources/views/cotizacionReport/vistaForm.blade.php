
@extends('layouts.app')

@section('mi_estilo')
<style>

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #355296;
}

input:focus + .slider {
  box-shadow: 0 0 1px #355296;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

  .transformacion {
     text-transform: lowercase;
  }
    .div1 {
  background-color: #fafafa;
  margin: 1rem;
  padding: 1rem;
  border: 2px solid #ccc;
  /* IMPORTANTE */
  text-align: center;
}
.div2{
   background-color: #fafafa;
  
   border: 1px solid #CCC;
   align-items: center;
   padding: 1rem;
}
    table{  
         width:600px;  
         text-align:center;  
         }  
         thead tr th { 
            position: sticky;
            top: 0;
            z-index: 10;
      
            color: rgb(255, 255, 255)
        }
    
        .table-responsive { 
            height:100%;
            overflow:scroll;
        }
     table tr th,td{  
         height:30px;  
         line-height:30px;  
         border:1px solid #ccc;  
         }  
      #pageStyle{  
         display:inline-block;  
         width:32px;  
         height:32px;  
         border:1px solid #CCC;  
         line-height:32px;  
         text-align:center;  
         color:#999;  
         margin-top:20px;  
         text-decoration:none;  
      
         }  
      #pageStyle:hover{  
          background-color:#CCC;  
          }  
      #pageStyle .active{  
          background-color:#ffffff;  
          color:#ffffff;  
          } 
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

/* this is for the main container of the table, also sets the height of the fixed header row */
.headercontainer {
  position: relative;

  padding-top: 10px;
 
}
/* this is for the data area that is scrollable */
.tablecontainer {
  overflow-y: auto;
  height: 500px;
 
}

/* remove default cell borders and ensures table width 100% of its container*/
.tablecontainer table {
  border-spacing: 0;
  width:100%;
}

/* add a thin border to the left of cells, but not the first */
.tablecontainer td + td {
  border-left:1px solid #eee; 
}

/* cell padding and bottom border */
.tablecontainer td, th {

  padding: 10px;
}

/* make the default header height 0 and make text invisible */
.tablecontainer th {
    
    
    white-space: nowrap;
}

/* reposition the divs in the header cells and place in the blank area of the headercontainer */
.tablecontainer th div{
  visibility: visible;
  position: absolute;
  background: rgb(132, 125, 125);

  padding: 9px 10px;
  top: 0;
  margin-left: -10px;
  line-height: normal;
   border-left: 1px solid #222;
}
/* prevent the left border from above appearing in first div header */
th:first-child div{
  border: none;
}

/* alternate colors for rows */
.tablecontainer tbody  tr:nth-child(even){
     background-color: #ddd;
}
.parrafo{
  font-size: 10px;
}


</style>
@endsection
@include('layouts.sidebar', ['hide'=>'0']) 
@section('content')


<meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="container border rounded">
       <!--<meta http-equiv="refresh" content="10" />---> 

      
          <div class="row pt-1 border-primary" style="margin-top:1px; border-top: solid;">
            <div class="col-12 d-flex justify-content-center"><h3>REPORTE COTIZACION</h3></div>
          </div>
          <div class="row">
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

<br><br>

          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col">
              
              </div>
              <div class="col">
                <p class="text-primary" hidden>importe total: <span id="suma" > 0000</span></p>
              </div>
            </div>
            <div class="row justify-content-md-center">
              <div class="col-md-auto">
                <input type="button" value="Ver sin contizar" class="btn btn-outline-primary"  id="d22"/> 
                <input type="button" value="Ver sin facturar" class="btn btn-outline-primary"  id="d23"/> 
                <input type="button" value="Ver anulados" class="btn btn-outline-primary"  id="d2"/> 
                <input type="button" value="Renovar vista" class="btn btn-outline-primary"  id="d1"/> 
                <input type="button" value="Actualizar" class="btn btn-outline-primary" onclick="location.reload()"/>
                <button type="button" class="btn btn-outline-success" id="exportar">Export</button>

              </div>
            
          <div class="col">

          </div>

          <div class="col-md-auto">
              Buscar:
          </div>
              <div class="col-md-auto">
   
                <form class="form-inline" action="" method="GET">
      <input id="busG" name="busG" class="form-control col-4 col-sm-auto ml-auto" data-type="search" placeholder="" value ="" aria-label="Search" >
                </form>
              </div>
            </div>
          </div>
         
              
            </div>
         
       
          
     <br>
 

 
    <div class="container">
      <div class="row">
        <div class="col">
          
        </div>
        <div class="col">
          
        </div>
        <div class="col">
       
        </div>
        <div class="col">
        
        </div>
        <div class="col">

        </div>
        <div class="col col-lg-2">
          
        </div>
       
        <div class="col">
          <select name="menu" id="op"  class="btn btn-primary dropdown-toggle">
            <span>paginas a visualizar</span>
          
            <option value="1000000" id="a0">-</option>
            <option value="10" id="a1">10</option>
            <option value="20" id="a2">20</option>
            <option value="50" id="a3">50</option>
            <option value="100" id="a4">100</option>
              
          </select>
        </div>
      </div>
    </div>
  
    <div class="table-responsive text-center" >

      <div class="headercontainer">
        <div class="tablecontainer">

        <table class="table table-bordered table-sm" id="miTabla">
          <thead >
            <th style="width: 180px; border-style: hidden;  position: static" scope="col">  <p class="text-primary" >Encontrados: <span id="parrafo"> 0</span></p></th>
            <th style="width:100px; border-style: hidden" scope="col">
              <form class="form-inline" action="" method="GET">
                <input id="busqueda1" name="busqueda1" class="form-control col-4 col-sm-auto ml-auto" type="search" placeholder="Buscar Nro Cot (Solo numeros)" value ="" aria-label="Search" onkeypress='return validaNumericos(event)' >
      </form>
            </th>
            <th style="width: 600px; border-style: hidden" scope="col">
              <form class="form-inline" action="" method="GET">
                <input id="busqueda2" name="busqueda2" class="form-control col-4 col-sm-auto ml-auto" type="search" placeholder="Buscar Cliente" value ="" aria-label="Search">
                  
              </form></th> 
            <th style="width: 300px; border-style: hidden" scope="col"></th> 
            <th style="width: 160px; border-style: hidden" scope="col">
              <form class="form-inline" action="" method="GET">
                <input id="busqueda3" name="busqueda3" class="form-control col-4 col-sm-auto ml-auto" type="search" placeholder="Buscar NR (Solo numeros)" value ="" aria-label="Search" onkeypress='return validaNumericos(event)'>
           </form></th>
            <th style="width: 190px; border-style: hidden" scope="col"></th>
            
            <th style="width: 10px; border-style: hidden" scope="col"></th>
            <th style="width: 30px; border-style: hidden" scope="col"></th>
            <th style="width: 130px; border-style: hidden" scope="col">
              <form class="form-inline" action="" method="GET">
                <input id="busqueda5" name="busqueda5" class="form-control col-4 col-sm-auto ml-auto" data-type="search" placeholder="Busqueda por vendedor" value ="" aria-label="Search" >
              </form>
            </th>
            <th style="width: 130px; border-style: hidden" scope="col">     <form class="form-inline" action="" method="GET">
              <input id="busqueda6" name="busqueda6" class="form-control col-4 col-sm-auto ml-auto" data-type="search" placeholder="Local" value ="" aria-label="Search" >
            </form></th>
            <th style="width: 130px; border-style: hidden" scope="col"></th>
            <th style="width: 130px; border-style: hidden" scope="col">
              
              <form class="form-inline" action="" method="GET">
                <input id="busqueda4" name="busqueda4" class="form-control col-4 col-sm-auto ml-auto" data-type="search" placeholder="Buscar #fac (Solo numeros)" value ="" aria-label="Search" onkeypress='return validaNumericos(event)'>
              </form>
            </th>
            <th style="width: 70px; border-style: hidden" scope="col">
  
            </th>
            <th style="width: 30px; border-style: hidden" scope="col"></th>
           
            <th style="width: 130px; border-style: hidden" scope="col"></th>
            <th style="width: 130px; border-style: hidden" scope="col"></th>
        </thead>
        
         <thead class="bg-primary text-light">
            <th style="width: 140px; background-color: rgb(37, 49, 104)" class="header" scope="col">Fecha Cot</th>
            <th style="width: 100px; background-color: rgb(37, 49, 104)"class="header" scope="col">Nro Cot</th>
            <th style="width: 600px; background-color: rgb(37, 49, 104)"class="header" scope="col">Cliente</th> 
            <th style="width: 300px; background-color: rgb(37, 49, 104)"class="header" scope="col">Fecha NR</th> 
            <th style="width: 160px; background-color: rgb(37, 49, 104)"class="header" scope="col">NR</th>
            <th style="width: 190px; background-color: rgb(37, 49, 104)"class="header" scope="col">Total Ventas</th>
            
            <th style="width: 10px; background-color: rgb(37, 49, 104)"class="header" scope="col">Moneda</th>
            <th style="width: 70px; background-color: rgb(37, 49, 104)"class="header" scope="col">Estado NR</th>
            <th style="width: 130px; background-color: rgb(37, 49, 104)"class="header" scope="col">Usuario vendedor</th>
            <th style="width: 130px; background-color: rgb(37, 49, 104)"class="header" scope="col">Local</th>
            <th style="width: 130px; background-color: rgb(37, 49, 104)"class="header" scope="col">Fecha fac</th>
            <th style="width: 130px; background-color: rgb(37, 49, 104)"class="header" scope="col">Nro Fac</th>
            <th style="width: 70px; background-color: rgb(37, 49, 104)"class="header" scope="col">Estado Fac</th>

            <th style="width: 30px; background-color: rgb(37, 49, 104)"class="header" scope="col">S</th>
            <th style="width: 30px; background-color: rgb(37, 49, 104)"class="header" scope="col">E</th>
            <th style="width: 130px; background-color: rgb(37, 49, 104)"class="header" scope="col">OBS</th>
        </thead>

         @if ($observacionBD->isEmpty())
           
             @foreach($consutas as $co)
             <tbody>
              <tr>
                  <td style="text-align:center" class="bold">{{$co->Fecha}}</td> 
                  @if(strval($co->NroCotizacion)==="0")
                  <td style="text-align:center" class="bold">-</td>
                  @else
                  <td style="text-align:center" class="bold">{{$co->NroCotizacion}}</td> 
                  @endif                   
                  
                  <td style="text-align:center" class="bold">{{$co->Cliente}}</td>
                  <td style="text-align:center" class="bold">{{$co->FechaNR}}</td>
                  <td style="text-align:center" class="bold">{{$co->NR}}</td>
                  <td style="text-align:center" class="bold">{{$co->Totalventas}}</td>
                  <td style="text-align:center" class="bold">{{$co->Moneda}}</td>
                  <td style="text-align:center" class="bold">{{$co->estadoNR}}</td> 
                  <td style="text-align:center" class="bold">{{$co->Usuario}}</td>
                  <td style="text-align:center" class="bold">{{$co->Local}}</td>
                  @if (is_null($co->FechaFac))
                  <td style="text-align:center" class="bold" >-</td>
                  @else
                  <td style="text-align:center" class="bold">{{$co->FechaFac}}</td>
                  @endif
                                      
                  @if (is_null($co->numerofactura))
                  <td style="text-align:center" class="bold" >-</td>
                  @else
                  <td style="text-align:center" class="bold">{{$co->numerofactura}}</td> 
                  @endif
                  
                  
                  @if (is_null($co->estado))
                  <td style="text-align:center" class="bold" >-</td>
                  @else
                  <td style="text-align:center" class="bold">{{$co->estado}}</td> 
                  @endif
               
                  <td style="text-align:center" class="bold"></td> 
                  <td style="text-align:center" class="bold"></td> 
                  <td style="text-align:center" class="bold"> 
                     
                  <button type="button"  id="{{$co->NR}}" onclick="obtenerId(this.id)" class="btn btn-outline-primary btnHT"  data-bs-toggle="modal" data-bs-target="#exampleModal99"  data-bs-whatever="@mdo"><span><i class="fa fa-plus" aria-hidden="true"></i></span></button></td> 
                  
                
              </tr>
            </tbody>
                   @endforeach
         @else
           
@foreach($consutas as $co)
@foreach ($observacionBD as $item)
@if ($co->NR==$item->id)
<tbody>
 <tr>
     <td style="text-align:center" class="bold">{{$co->Fecha}}</td> 
     @if(strval($co->NroCotizacion)==="0")
     <td style="text-align:center" class="bold">-</td>
     @else
     <td style="text-align:center" class="bold">{{$co->NroCotizacion}}</td> 
     @endif                   
     
     <td style="text-align:center" class="bold">{{$co->Cliente}}</td>
     <td style="text-align:center" class="bold">{{$co->FechaNR}}</td>
     <td style="text-align:center" class="bold">{{$co->NR}}</td>
     <td style="text-align:center" class="bold">{{$co->Totalventas}}</td>
     <td style="text-align:center" class="bold">{{$co->Moneda}}</td>
     @if ($co->estadoNR ==9)
     <td style="text-align:center" class="bold">a</td>  
     @else
     <td style="text-align:center" class="bold">v</td>    
     @endif
     <td style="text-align:center" class="bold">{{$co->Usuario}}</td>
     <td style="text-align:center" class="bold">{{$co->Local}}</td>
     @if (is_null($co->FechaFac))
     <td style="text-align:center" class="bold" >-</td>
     @else
     <td style="text-align:center" class="bold">{{$co->FechaFac}}</td>
     @endif
                         
     @if (is_null($co->numerofactura))
     <td style="text-align:center" class="bold" >-</td>
     @else
     <td style="text-align:center" class="bold">{{$co->numerofactura}}</td> 
     @endif
     
     
     @if (is_null($co->estado))
     <td style="text-align:center" class="bold" >-</td>
     @else
     <td style="text-align:center" class="bold">{{$co->estado}}</td> 
     @endif
   
     
     <td style="text-align:center" class="bold">
       @if ($item->nro==1)
       <span  class="text-info"><i class="text-info  fas fa-check fa-lg"></i></span>
       @endif   
       @if ($item->nro==2)
       <span class="text-danger"><i class="fa-lg text-danger fas fa-times"></i></span>
       @endif     
       </td>  

     <td style="text-align:center" class="bold"> 
    @if ($item->nroA==1&&$item->nroP==0&&$item->nroT==0)
    <span><i class="fa-lg text-adjud fas fa-handshake"></i></span>
    @endif
    @if ($item->nroA==1&&$item->nroP==1&&$item->nroT==0)
    <span class="text-warning"><i class="fas fa-star-half text-success fa-lg"></i></span>
    @endif
    @if ($item->nroA==1&&$item->nroP==1&&$item->nroT==1)
    <span class="text-success"><i class="fas fa-star text-success fa-lg"></i></span>
    @endif
    @if ($item->nroA==1&&$item->nroP==0&&$item->nroT==1)
    <span class="text-success"><i class="fas fa-star text-success fa-lg"></i></span>
    @endif
     </td>
     <td style="text-align:center" class="bold">    <a type="button" href="v/{{$co->NR}}/edit" id="" target="_blank" class="btn btn-outline-primary "><span><i class="fa fa-search"></i></span></a></td> 
 </td>
  
 </tr>
</tbody>
@break 
@endif
@endforeach
@if ($co->NR!=$item->id)
   
<tbody>
 <tr>
     <td style="text-align:center" class="bold">{{$co->Fecha}}</td> 
     @if(strval($co->NroCotizacion)==="0")
     <td style="text-align:center" class="bold">-</td>
     @else
     <td style="text-align:center" class="bold">{{$co->NroCotizacion}}</td> 
     @endif                   
     
     <td style="text-align:center" class="bold">{{$co->Cliente}}</td>
     <td style="text-align:center" class="bold">{{$co->FechaNR}}</td>
     <td style="text-align:center" class="bold">{{$co->NR}}</td>
     <td style="text-align:center" class="bold">{{$co->Totalventas}}</td>
     <td style="text-align:center" class="bold">{{$co->Moneda}}</td>
     @if ($co->estadoNR ==9)
     <td style="text-align:center" class="bold">a</td>  
     @else
     <td style="text-align:center" class="bold">v</td>    
     @endif
     <td style="text-align:center" class="bold">{{$co->Usuario}}</td>
     <td style="text-align:center" class="bold">{{$co->Local}}</td>
     @if (is_null($co->FechaFac))
     <td style="text-align:center" class="bold" >-</td>
     @else
     <td style="text-align:center" class="bold">{{$co->FechaFac}}</td>
     @endif
                         
     @if (is_null($co->numerofactura))
     <td style="text-align:center" class="bold" >-</td>
     @else
     <td style="text-align:center" class="bold">{{$co->numerofactura}}</td> 
     @endif
     
     
     @if (is_null($co->estado))
     <td style="text-align:center" class="bold" >-</td>
     @else
     <td style="text-align:center" class="bold">{{$co->estado}}</td> 
     @endif
   
     
     <td style="text-align:center" class="bold"></td> 
     <td style="text-align:center" class="bold"></td> 
     <td style="text-align:center" class="bold"> 
        
     <button type="button"  id="{{$co->NR}}" onclick="obtenerId(this.id)" class="btn btn-outline-primary btnHT"  data-bs-toggle="modal" data-bs-target="#exampleModal99"  data-bs-whatever="@mdo"><span><i class="fa fa-plus" aria-hidden="true"></i></span></button></td> 
     
   
 </tr>
</tbody>
@endif
@endforeach
         
         
         
         @endif

      

         
        
      </table>
     
    </div>
  </div>    
</div>   

<div class="page" id="page"></div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
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
                  <input type="hidden" id="name1" name="id_cotizacion" required minlength="4" maxlength="8" size="20" value="132132132">
                  <input type="hidden" id="name2" name="iduser" maxlength="8" size="10" value="{{Auth::user()->id}}">
                  <br>
                  <label for="message-text" class="col-form-label" >Escriba la observacion:</label>
                  <textarea class="form-control" id="message-text" placeholder="Escriba su observacion" name="comentario" required ></textarea>
                </div>
                <span>Usuario: {{auth()->user()->perfiles->nombre}} {{auth()->user()->perfiles->paterno}} {{auth()->user()->perfiles->materno}}</span>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <!---------boton ----->
              
           
              <button type="sumit" class="btn btn-primary btnEditar" >Enviar observacion</button>
            </div>
        </form>
        </div>
          </div>
        </div>
      </div>

@endsection
@section('mis_scripts')

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>


<script>
  $(document).ready(()=>{
    $("#exportar").click(function(){
  $("#miTabla").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "SomeFile", //do not include extension
    fileext: ".xls" // file extension
  }); 
});
  });

</script>
<script>

//buscador en general
$(document).ready(function(){

$("#busG").keyup(function(){
_this = this;

    $.each($("#miTabla tbody tr"), function() {

    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });

});

});

///////
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


//función que realiza la busqueda
function jsBuscar1(){
 
 //obtenemos el valor insertado a buscar
 buscar=$("#busqueda1").prop("value");

 //utilizamos esta variable solo de ayuda y mostrar que se encontro
 encontradoResultado=false;

 //realizamos el recorrido solo por las celdas que contienen el código, que es la primera
 $("#miTabla tr").find('td:eq(1)').each(function () {

      //obtenemos el codigo de la celda
       codigo = $(this).html();

        //comparamos para ver si el código es igual a la busqueda
        if(codigo==buscar){

             //aqui ya que tenemos el td que contiene el codigo utilizaremos parent para obtener el tr.
             trDelResultado=$(this).parent();

             //ya que tenemos el tr seleccionado ahora podemos navegar a las otras celdas con find
             a0=trDelResultado.find("td:eq(0)").html();
             a1=trDelResultado.find("td:eq(1)").html();
             a2=trDelResultado.find("td:eq(2)").html();
             a3=trDelResultado.find("td:eq(3)").html();
             a4=trDelResultado.find("td:eq(4)").html();
             a5=trDelResultado.find("td:eq(5)").html();
             a6=trDelResultado.find("td:eq(6)").html();
             a7=trDelResultado.find("td:eq(7)").html();
             a8=trDelResultado.find("td:eq(8)").html();
             a9=trDelResultado.find("td:eq(9)").html();
             a10=trDelResultado.find("td:eq(10)").html();
             a11=trDelResultado.find("td:eq(11)").html();
             a12=trDelResultado.find("td:eq(12)").html();
             a13=trDelResultado.find("td:eq(13)").html();
             a14=trDelResultado.find("td:eq(14)").html();
                 
             //mostramos el resultado en el div
             $("#div0").html(a0)
             $("#div1").html(a1)
             $("#div2").html(a2)
             $("#div3").html(a3)
             $("#div4").html(a4)
             $("#div5").html(a5)
             $("#div6").html(a6)
             $("#div7").html(a7)
             $("#div8").html(a8)
             $("#div9").html(a9)
             $("#div10").html(a10)
             $("#div11").html(a11)
             $("#div12").html(a12)
             $("#div13").html(a13)
             $("#div14").html(a14)
           
             encontradoResultado=true;

        }

 })

 //si no se encontro resultado mostramos que no existe.
 if(!encontradoResultado){
  $("#h").html("No existe el código: "+busqueda1);
  $(document).ready(function() {
    setTimeout(function() {
        $(".cont").fadeOut(200);
    },3000);

});
 }

}




     
     //función que realiza la busqueda
function jsBuscar2(){
 
 //obtenemos el valor insertado a buscar
 buscar=$("#busqueda2").prop("value");
buscar=buscar.toUpperCase();
 //utilizamos esta variable solo de ayuda y mostrar que se encontro
 encontradoResultado=false;

 //realizamos el recorrido solo por las celdas que contienen el código, que es la primera
 $("#miTabla tr").find('td:eq(2)').each(function () {
  
     //let posicion = cadena.indexOf(termino);
      //obtenemos el codigo de la celda
       codigo = $(this).html();
    
        //comparamos para ver si el código es igual a la busqueda
        if(codigo==buscar){

             //aqui ya que tenemos el td que contiene el codigo utilizaremos parent para obtener el tr.
             trDelResultado=$(this).parent();

             //ya que tenemos el tr seleccionado ahora podemos navegar a las otras celdas con find
             a0=trDelResultado.find("td:eq(0)").html();
             a1=trDelResultado.find("td:eq(1)").html();
             a2=trDelResultado.find("td:eq(2)").html();
             a3=trDelResultado.find("td:eq(3)").html();
             a4=trDelResultado.find("td:eq(4)").html();
             a5=trDelResultado.find("td:eq(5)").html();
             a6=trDelResultado.find("td:eq(6)").html();
             a7=trDelResultado.find("td:eq(7)").html();
             a8=trDelResultado.find("td:eq(8)").html();
             a9=trDelResultado.find("td:eq(9)").html();
             a10=trDelResultado.find("td:eq(10)").html();
             a11=trDelResultado.find("td:eq(11)").html();
             a12=trDelResultado.find("td:eq(12)").html();
             a13=trDelResultado.find("td:eq(13)").html();
             a14=trDelResultado.find("td:eq(14)").html();
                 
             //mostramos el resultado en el div
             $("#div0").html(a0)
             $("#div1").html(a1)
             $("#div2").html(a2)
             $("#div3").html(a3)
             $("#div4").html(a4)
             $("#div5").html(a5)
             $("#div6").html(a6)
             $("#div7").html(a7)
             $("#div8").html(a8)
             $("#div9").html(a9)
             $("#div10").html(a10)
             $("#div11").html(a11)
             $("#div12").html(a12)
             $("#div13").html(a13)
             $("#div14").html(a14)
           
             encontradoResultado=true;

        }

 })

 //si no se encontro resultado mostramos que no existe.
 if(!encontradoResultado){
  $("#h").html("No existe el cliente: "+buscar)
 $(document).ready(function() {
    setTimeout(function() {
        $(".cont").fadeOut(200);
    },3000);

});

 }
 
}
$(document).ready(function() {
  $('#busqueda').click(function() {
    $('input[type="text"]').val('');
  });
});


     //función que realiza la busqueda
function jsBuscar3(){
 
 //obtenemos el valor insertado a buscar
 buscar=$("#busqueda3").prop("value");

 //utilizamos esta variable solo de ayuda y mostrar que se encontro
 encontradoResultado=false;

 //realizamos el recorrido solo por las celdas que contienen el código, que es la primera
 $("#miTabla tr").find('td:eq(4)').each(function () {

      //obtenemos el codigo de la celda
      codigo = $(this).html();

        //comparamos para ver si el código es igual a la busqueda
        if(codigo==buscar){

             //aqui ya que tenemos el td que contiene el codigo utilizaremos parent para obtener el tr.
             trDelResultado=$(this).parent();

             //ya que tenemos el tr seleccionado ahora podemos navegar a las otras celdas con find
             a0=trDelResultado.find("td:eq(0)").html();
             a1=trDelResultado.find("td:eq(1)").html();
             a2=trDelResultado.find("td:eq(2)").html();
             a3=trDelResultado.find("td:eq(3)").html();
             a4=trDelResultado.find("td:eq(4)").html();
             a5=trDelResultado.find("td:eq(5)").html();
             a6=trDelResultado.find("td:eq(6)").html();
             a7=trDelResultado.find("td:eq(7)").html();
             a8=trDelResultado.find("td:eq(8)").html();
             a9=trDelResultado.find("td:eq(9)").html();
             a10=trDelResultado.find("td:eq(10)").html();
             a11=trDelResultado.find("td:eq(11)").html();
             a12=trDelResultado.find("td:eq(12)").html();
             a13=trDelResultado.find("td:eq(13)").html();
             a14=trDelResultado.find("td:eq(14)").html();
                 
             //mostramos el resultado en el div
             $("#div0").html(a0)
             $("#div1").html(a1)
             $("#div2").html(a2)
             $("#div3").html(a3)
             $("#div4").html(a4)
             $("#div5").html(a5)
             $("#div6").html(a6)
             $("#div7").html(a7)
             $("#div8").html(a8)
             $("#div9").html(a9)
             $("#div10").html(a10)
             $("#div11").html(a11)
             $("#div12").html(a12)
             $("#div13").html(a13)
             $("#div14").html(a14)
           
             encontradoResultado=true;

        }

 })

 //si no se encontro resultado mostramos que no existe.
 if(!encontradoResultado){
  $("#h").html("No existe la nota de remision: "+buscar)
 $(document).ready(function() {
    setTimeout(function() {
        $(".cont").fadeOut(200);
    },3000);

});

 }
}
$(document).ready(function() {
  $('#busqueda').click(function() {
    $('input[type="text"]').val('');
  });
});
/** 
 *  $('#op').change(function( ) {
         var val = $("#op option:selected").text();
         var currentPage = 0;// El valor predeterminado de la página actual es 0  
          if (val==10) {
           // Número que se muestra en cada página  
           return val;
          }     
        
          if (val==20) {
  
            return val;
          }   
          if (val==50) {
            // Número que se muestra en cada página  
            return val;
          }  
          
        });
 * 
*/


$(function(){  
         var $table = $("#miTabla"); 
        var pageSize=10;

      

         $('#op').change(function() {
         var val = $("#op option:selected").text();
         
         if (val=="-") {
                
          $('#page').text("");
            var pageSize = 100000000;// Número que se muestra en cada página  
       var currentPage = 0;// El valor predeterminado de la página actual es 0 
         $table.bind('paging',function(){  
             $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();  
         });       
         var sumRows = $table.find('tbody tr').length;  
         var sumPages = Math.ceil(sumRows/pageSize);//paginas totales    
           
         var $pager = $('#page');  // Crea un nuevo div, coloca una etiqueta, muestra el número de página inferior  
         for(var pageIndex = 0 ; pageIndex<sumPages ; pageIndex++){  
             $('<a href="#" id="pageStyle" onclick="changCss(this)"><span>'+(pageIndex+1)+'</span></a>').bind("click",{"newPage":pageIndex},function(event){  
                 currentPage = event.data["newPage"];  
                 $table.trigger("paging");  
                   // Activar la función de paginación  
                 }).appendTo($pager);  
                 $pager.append(" ");  
             }     
             $pager.insertAfter($table);  
             $table.trigger("paging");  
               
             // El efecto predeterminado de una etiqueta en la primera página  
             var $pagess = $('#pageStyle');  
             //$pagess[0].style.backgroundColor="#006B00";  
             //$pagess[0].style.color="#ffffff"
          }    
         
         if (val==10) {
            $('#page').text("");
            var pageSize = 10;// Número que se muestra en cada página  
       var currentPage = 0;// El valor predeterminado de la página actual es 0 
         $table.bind('paging',function(){  
             $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();  
         });       
         var sumRows = $table.find('tbody tr').length;  
         var sumPages = Math.ceil(sumRows/pageSize);//paginas totales    
           
         var $pager = $('#page');  // Crea un nuevo div, coloca una etiqueta, muestra el número de página inferior  
         for(var pageIndex = 0 ; pageIndex<sumPages ; pageIndex++){  
             $('<a href="#" id="pageStyle" onclick="changCss(this)"><span>'+(pageIndex+1)+'</span></a>').bind("click",{"newPage":pageIndex},function(event){  
                 currentPage = event.data["newPage"];  
                 $table.trigger("paging");  
                   // Activar la función de paginación  
                 }).appendTo($pager);  
                 $pager.append(" ");  
             }     
             $pager.insertAfter($table);  
             $table.trigger("paging");  
               
             // El efecto predeterminado de una etiqueta en la primera página  
             var $pagess = $('#pageStyle');  
             //$pagess[0].style.backgroundColor="#006B00";  
             //$pagess[0].style.color="#ffffff"
          
          }     
        
          if (val==20) {
         $('#page').text("");
            var pageSize = 20;// Número que se muestra en cada página  
       var currentPage = 0;// El valor predeterminado de la página actual es 0 
         $table.bind('paging',function(){  
             $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();  
         });       
         var sumRows = $table.find('tbody tr').length;  
         var sumPages = Math.ceil(sumRows/pageSize);//paginas totales    
           
         var $pager = $('#page');  // Crea un nuevo div, coloca una etiqueta, muestra el número de página inferior  
         for(var pageIndex = 0 ; pageIndex<sumPages ; pageIndex++){  
             $('<a href="#" id="pageStyle" onclick="changCss(this)"><span>'+(pageIndex+1)+'</span></a>').bind("click",{"newPage":pageIndex},function(event){  
                 currentPage = event.data["newPage"];  
                 $table.trigger("paging");  
                   // Activar la función de paginación  
                 }).appendTo($pager);  
                 $pager.append(" ");  
             }     
             $pager.insertAfter($table);  
             $table.trigger("paging");  
               
             // El efecto predeterminado de una etiqueta en la primera página  
             var $pagess = $('#pageStyle');  
             //$pagess[0].style.backgroundColor="#006B00";  
             //$pagess[0].style.color="#ffffff";  
          }   
          if (val==50) {
         $('#page').text("");
            var pageSize = 50;// Número que se muestra en cada página  
       var currentPage = 0;// El valor predeterminado de la página actual es 0 
         $table.bind('paging',function(){  
             $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();  
         });       
         var sumRows = $table.find('tbody tr').length;  
         var sumPages = Math.ceil(sumRows/pageSize);//paginas totales    
           
         var $pager = $('#page');  // Crea un nuevo div, coloca una etiqueta, muestra el número de página inferior  
         for(var pageIndex = 0 ; pageIndex<sumPages ; pageIndex++){  
             $('<a href="#" id="pageStyle" onclick="changCss(this)"><span>'+(pageIndex+1)+'</span></a>').bind("click",{"newPage":pageIndex},function(event){  
                 currentPage = event.data["newPage"];  
                 $table.trigger("paging");  
                   // Activar la función de paginación  
                 }).appendTo($pager);  
                 $pager.append(" ");  
             }     
             $pager.insertAfter($table);  
             $table.trigger("paging");  
               
             // El efecto predeterminado de una etiqueta en la primera página  
             var $pagess = $('#pageStyle');  
         
          } 
          if (val==100) {
         $('#page').text("");
            var pageSize = 100;// Número que se muestra en cada página  
       var currentPage = 0;// El valor predeterminado de la página actual es 0 
         $table.bind('paging',function(){  
             $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();  
         });       
         var sumRows = $table.find('tbody tr').length;  
         var sumPages = Math.ceil(sumRows/pageSize);//paginas totales    
           
         var $pager = $('#page');  // Crea un nuevo div, coloca una etiqueta, muestra el número de página inferior  
         for(var pageIndex = 0 ; pageIndex<sumPages ; pageIndex++){  
             $('<a href="#" id="pageStyle" onclick="changCss(this)"><span>'+(pageIndex+1)+'</span></a>').bind("click",{"newPage":pageIndex},function(event){  
                 currentPage = event.data["newPage"];  
                 $table.trigger("paging");  
                   // Activar la función de paginación  
                 }).appendTo($pager);  
                 $pager.append(" ");  
             }     
             $pager.insertAfter($table);  
             $table.trigger("paging");  
               
             // El efecto predeterminado de una etiqueta en la primera página  
             var $pagess = $('#pageStyle');  
             //$pagess[0].style.backgroundColor="#006B00";  
             //$pagess[0].style.color="#ffffff";  
          } 
          if (val==50) {
         $('#page').text("");
            var pageSize = 50;// Número que se muestra en cada página  
       var currentPage = 0;// El valor predeterminado de la página actual es 0 
         $table.bind('paging',function(){  
             $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();  
         });       
         var sumRows = $table.find('tbody tr').length;  
         var sumPages = Math.ceil(sumRows/pageSize);//paginas totales    
           
         var $pager = $('#page');  // Crea un nuevo div, coloca una etiqueta, muestra el número de página inferior  
         for(var pageIndex = 0 ; pageIndex<sumPages ; pageIndex++){  
             $('<a href="#" id="pageStyle" onclick="changCss(this)"><span>'+(pageIndex+1)+'</span></a>').bind("click",{"newPage":pageIndex},function(event){  
                 currentPage = event.data["newPage"];  
                 $table.trigger("paging");  
                   // Activar la función de paginación  
                 }).appendTo($pager);  
                 $pager.append(" ");  
             }     
             $pager.insertAfter($table);  
             $table.trigger("paging");  
               
             // El efecto predeterminado de una etiqueta en la primera página  
             var $pagess = $('#pageStyle');  
             //$pagess[0].style.backgroundColor="#006B00";  
             //$pagess[0].style.color="#ffffff";  
          } 
        });
         
         
      
    });  
      
    // haga clic en un enlace para cambiar el color, luego haga clic en otro para restaurar el color original  
      function changCss(obj){  
        var arr = document.getElementsByTagName("a");  
        for(var i=0;i<arr.length;i++){     
         if(obj==arr[i]){       // Estilo de página actual  
          obj.style.backgroundColor="#355296";  
          obj.style.color="#ffffff";  
        }  
         else  
         {  
           arr[i].style.color="";  
           arr[i].style.backgroundColor="";  
         }  
        }  
     }      
    
     function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}

// mejora del buscador nro cotizacion
$(document).ready(function(){
$("#busqueda1").keyup(function(){
_this = this;

    $.each($("#miTabla tbody tr"), function() {
      let nombres = $(this).children().eq(1);
    if($(nombres).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });

});

});


//mejora del buscador, cliente
$(document).ready(function(){
$("#busqueda2").keyup(function(){
_this = this;

    $.each($("#miTabla tbody tr"), function() {
      let nombres = $(this).children().eq(2);
    if($(nombres).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });

});

});



// otro buscador3 busca segun la table se mejora del primer buscador
$(document).ready(function(){
$("#busqueda3").keyup(function(){
_this = this;

    $.each($("#miTabla tbody tr"), function() {
      let nombres = $(this).children().eq(4);
    if($(nombres).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });

});

});



// otro buscador6 segun local
$(document).ready(function(){
$("#busqueda6").keyup(function(){
_this = this;

    $.each($("#miTabla tbody tr"), function() {
      let nombres = $(this).children().eq(9);
    if($(nombres).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });

});

});

      
  // busca por numero de factura 
$(document).ready(function(){
$("#busqueda4").keyup(function(){
_this = this;

    $.each($("#miTabla tbody tr"), function() {
      let nombres = $(this).children().eq(11);
    if($(nombres).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });

});

});


  // busca por vendedor
  $(document).ready(function(){
$("#busqueda5").keyup(function(){
_this = this;

    $.each($("#miTabla tbody tr"), function() {
      let nombres = $(this).children().eq(8);
    if($(nombres).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });

});

});
// buscar anualciom Nota de remicion
$(document).ready(() => {
  
  var Nanulados=0;
            $('#x02').click(function(evento) {
              $('#page').text("");
                evento.preventDefault();

                let clave = "v";
                let clave2 ="a";

                if (clave2) {
        
                   
                  $('table').find('tbody tr').hide();

                    $('table tbody tr').each(function() {
                        let nombres = $(this).children().eq(12);
                
                        if (nombres.text().toUpperCase().includes(clave2.toUpperCase())) {
                            $(this).show();
                        }
                    });

                 //contador de anuladas 
                 var nFilas = $("#miTabla tr").length;
                 var sumaAnulados=0;
                 var contador=0;
               //  var valo3=0;
                 $("#miTabla tr").find('td:eq(11)').each(function () {
 
                  //obtenemos el valor de la celda
                    valor = $(this).html();
                  if (valor=='-') {
                    contador=contador+1;
                
                  
                  }
                 
              
            });
        
            

            //mostramos el total
              
                  $('#parrafo').text(contador); 
               //   $('#suma').text(sumaAnulados.toFixed(2));

                }
            });
        });

// busca estados sin anular de nro de cotizacion 
$(document).ready(() => {
  
  var Nanulados=0;
            $('#x01').click(function(evento) {
              $('#page').text("");
                evento.preventDefault();

                let clave = "-";
                let clave2 ="a";

                if (clave || clave2) {
        
                   
                  $('table').find('tbody tr').hide();

                    $('table tbody tr').each(function() {
                        let nombres = $(this).children().eq(1);
                        let nombres2 = $(this).children().eq(12);
                        if (nombres.text().toUpperCase().includes(clave.toUpperCase())&&nombres2.text().toUpperCase().includes(clave2.toUpperCase())) {
                            $(this).show();
                        }
                    });

                 //contador de anuladas 
                 var nFilas = $("#miTabla tr").length;
                 var sumaAnulados=0;
                 var contador=0;
               //  var valo3=0;
                 $("#miTabla tr").find('td:eq(11)').each(function () {
 
                  //obtenemos el valor de la celda
                    valor = $(this).html();
                  if (valor=='-') {
                    contador=contador+1;
                
                  
                  }
                 
              
            });
        
            

            //mostramos el total
              
                  $('#parrafo').text(contador); 
               //   $('#suma').text(sumaAnulados.toFixed(2));

                }
            });
        });


// busca estados sin anular
$(document).ready(() => {
  
  var Nanulados=0;
            $('#d23').click(function(evento) {
              $('#page').text("");
                evento.preventDefault();

                let clave = "-";
                let clave2 = "v";

                if (clave) {
        
                   
                  $('table').find('tbody tr').hide();

                    $('table tbody tr').each(function() {
                        let nombres = $(this).children().eq(11);
                        let nombres2 = $(this).children().eq(7);

                        if (nombres.text().toUpperCase().includes(clave.toUpperCase())&&nombres2.text().toUpperCase().includes(clave2.toUpperCase())) {
                            $(this).show();
                        }
                    });

                 //contador de anuladas 
                 var nFilas = $("#miTabla tr").length;
                 var sumaAnulados=0;
                 var contador=0;
               //  var valo3=0;
                 $("#miTabla tr").find('td:eq(11)').each(function () {
 
                  //obtenemos el valor de la celda
                    valor = $(this).html();
                  if (valor=='-') {
                    contador=contador+1;
                
                  
                  }
                 
              
            });
        
            

            //mostramos el total
              
                  $('#parrafo').text(contador); 
               //   $('#suma').text(sumaAnulados.toFixed(2));

                }
            });
        });






// busca estados anulados
$(document).ready(() => {
  
  var Nanulados=0;
            $('#d2').click(function(evento) {
              $('#page').text("");
                evento.preventDefault();

                let clave = "a";

                if (clave) {
        
                   
                  $('table').find('tbody tr').hide();

                    $('table tbody tr').each(function() {
                        let nombres = $(this).children().eq(12);

                        if (nombres.text().toUpperCase().includes(clave.toUpperCase())) {
                            $(this).show();
                        }
                    });

                 //contador de anuladas 
                 var nFilas = $("#miTabla tr").length;
                 var sumaAnulados=0;
                 var contador=0;
               //  var valo3=0;
                 $("#miTabla tr").find('td:eq(11)').each(function () {
 
                  //obtenemos el valor de la celda
                    valor = $(this).html();
                  if (valor=='a') {
                    contador=contador+1;
                
                  
                  }
                 
              
            });
        
            

            //mostramos el total
              
                  $('#parrafo').text(contador); 
               //   $('#suma').text(sumaAnulados.toFixed(2));

                }
            });
        });
        


// busca estados Nro cot -
$(document).ready(() => {
  
  var Nanulados=0;
            $('#d22').click(function(evento) {
              $('#page').text("");
                evento.preventDefault();

                let clave = "-";

                if (clave) {
        
                   
                  $('table').find('tbody tr').hide();

                    $('table tbody tr').each(function() {
                        let nombres = $(this).children().eq(1);

                        if (nombres.text().toUpperCase().includes(clave.toUpperCase())) {
                            $(this).show();
                        }
                    });

                 //contador de anuladas 
                 var nFilas = $("#miTabla tr").length;
                 var sumaAnulados=0;
                 var contador=0;
               //  var valo3=0;
                 $("#miTabla tr").find('td:eq(1)').each(function () {
 
                  //obtenemos el valor de la celda
                    valor = $(this).html();
                  if (valor=='-') {
                    contador=contador+1;
                
                  
                  }
                 
              
            });
            // renovar vista.....
            $(document).ready(() => {
              var contador=0;
            $('#d1').click(function(evento) {
              $('#page').text("");
                evento.preventDefault();

                    $('table').find('tbody tr').show();

                    var nFilas = $("#miTabla tr").length;
                    $('#parrafo').text(nFilas);
            });
        });

            //mostramos el total
              
                  $('#parrafo').text(contador); 
               //   $('#suma').text(sumaAnulados.toFixed(2));

                }
            });
        });
          
     
  

        
        
          
    
       
       
//recarga segun el movimiento o pulsacion del tecledo contador en milisegundos  se mejoro 
        var time = new Date().getTime(); 
        $(document.body).bind("mousemove keypress", function(e) { 
          time = new Date().getTime();
         });
          function refresh() {
             if(new Date().getTime() - time >= 300000) 
             window.location.reload(true);
              else setTimeout(refresh, 10000); 
            } 
            setTimeout(refresh, 10000);

//contador de filas y columnas 
$(function () {
  $("#mi-boton").click(function () {
      var nFilas = $("#mi-tabla tr").length;
      var nColumnas = $("#mi-tabla tr:last td").length;
      var msg = "Filas: "+nFilas+" - Columnas: "+nColumnas;
      alert(msg);
    });
});

 //sumaTotal de ventas
                    var sumador=0;
                     $("#miTabla tr").find('td:eq(5)').each(function() {
                      //obtner el valor de la celda
                      valo2=$(this).html();
                      sumador=sumador+parseFloat(valo2);
                    
                     });

                     var nFilas2 = $("#miTabla tr").length;
                     $('#parrafo').text(nFilas2);

                     $('#suma').text(sumador.toFixed(2));
</script>
@endsection
