
@extends('layouts.app')

@section('mi_estilo')
<style>
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
                     
                            <div class="alert alert-danger" role="alert">
                              <h2 class="alert-heading">FACTURA SIN CONSOLIDAR</h2>
                           
                             <h3> Numero de transaccion: {{$NR}}</h3>   
                           
                             <input class="btn btn-outline-secondary" type = "button"  value = "Cerrar pagina" onClick = window.close(); />   
                              <hr>
                
                            </div>
                          
                        </div>
                      </div>

               </div>
                <!--------------------->
             </div>
         </div>
     </div>

       
    </div>
    
    
    
    

@endsection

@section('mis_scripts')

<script type="text/javascript">
  $(".page-wrapper").removeClass("toggled"); 
  </script>
 
<script language="javascript">
    // Este script es común a ie6 y ie7
   function custom_close(){
      
           window.close();

       
   }
   
  @endsection
 


