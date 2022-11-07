
@extends('layouts.app')

@section('mi_estilo')
<style>

.btn-final {
  position: absolute;
  right: 0;
  top: 0;
  padding-block-end: 10px;
  padding-top: 10px;
  padding-left:22px;
  bottom: 20% !important;
}
.input-tama{
  width: 35%;
  height: 34px;
}
table{  
         width:600px;  
         text-align:center;  
         }  
         thead tr th { 
            position: sticky;
            top: 0;
            z-index: 10;
            padding-top: 0;
      
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

         .pocion{
          position: absolute;
         } 
</style>
@endsection

@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 





<div class="container mt-4">
   
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row row-cols-12" id="pocion" class="pocion">
                            @foreach ($paso1 as $item)
                            <div class="alert alert-primary" role="alert">
                              <div class="row">
                                <div class="col">
                                  <h4 class="alert-heading">Datos de factura consolidada </h4>
                                </div>
                              
                                <div class="col" style="align-items: flex-end; ">
                                  <input class="btn-close btn-final " aria-label="Close" type = "button" style="align-items: flex-end" onClick = window.close(); />   
                     
                                </div>
                              </div>
                         
                              
                           
                           
                              <span style="font-size: 16px">NumeroTransaccion: {{$item->NroTrans}}   RazonSocial: {{$item->RazonSocial}}
                            
                              </span>
                              
                              
                             
                              <hr>

                              <div class="col"><span style="font-size: 17px">Fecha: {{$item->fecha}}    ImporteTotal: {{$item->total}}    Local: {{$item->Local}}    Estado: [{{$item->estado}}]    NumeroFactura: {{$item->Factura}}</span></div>
                     <hr>
                             
                      <input id="Nro" name="Nro" class="form-control col-4 col-sm-auto ml-auto input-tama" data-type="search" placeholder="Busqueda por NroTransaccion" value ="" aria-label="Search" onkeypress='return validaNumericos(event)'>
               
                            </div>
                       
                          @endforeach
                        </div>
                      </div>

                      

                
                  
                    

                        
                 </div>
                <!--------------------->
             </div>
         </div>
     </div>

       
    </div>
    
    
    <div class="modal-body" style="padding-top: 0">
      <div class="headercontainer">
        <div class="tablecontainer">
      <table class="table table-bordered table-sm" id="miTablaC">
        <thead class="bg-primary text-light">
        
          <tr >
            <th  style="text-align: center;color:#ffffff;background-color: rgb(37, 49, 104)" class="header" scope="col">Nro Transaccion</th> <br>
            <th   style="text-align: center;color:#ffffff;background-color: rgb(37, 49, 104)" class="header" scope="col">Fecha</th>
            <th   style="text-align: center;color:#ffffff;background-color: rgb(37, 49, 104)" class="header" scope="col">Importe</th>
            <th   style="text-align: center;color:#ffffff;background-color: rgb(37, 49, 104)" class="header" scope="col">Descuento</th>
            <th  style="text-align: center;color:#ffffff;background-color: rgb(37, 49, 104)" class="header" scope="col">Moneda</th>
         
            <th   style="text-align: center;color:#ffffff;background-color: rgb(37, 49, 104)" class="header" scope="col">Local</th>
            <th   style="text-align: center;color:#ffffff;background-color: rgb(37, 49, 104)" class="header" scope="col">Vendedor</th>
        </tr>  
       
           
        </thead>
          <tbody>
            @foreach ($paso2 as $key=> $valorX )
         
            <tr>
              <td style="text-align: center;">{{$valorX->NoTrans}}</td>
              <td style="text-align: center;">{{$valorX->Fecha}}</td>
              <td style="text-align: center;">{{$valorX->Importe}}</td>
              <td style="text-align: center;">{{$valorX->Descuento}}</td>
              <td style="text-align: center;">{{$valorX->Mon}}</td>
              <td style="text-align: center;">{{$valorX->Localv}}</td>
              <td style="text-align: center;">{{$valorX->Vendedor}}</td>
            </tr>
            @endforeach
         
          </tbody>
         
      </table>     
      </div>
    </div>
    </div>
</div>







    

@endsection

@section('mis_scripts')

<script type="text/javascript">
  $(".page-wrapper").removeClass("toggled"); 
  </script>
  <script>
    $(document).ready(function(){
$("#Nro").keyup(function(){
_this = this;

    $.each($("#miTablaC tbody tr"), function() {
      let nombres = $(this).children().eq(0);
    if($(nombres).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });

});

});
  </script>
  @endsection
 


