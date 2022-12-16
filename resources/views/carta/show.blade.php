@extends('layouts.app')
@section('static', 'statick-side')
@section('content') 
@include('layouts.sidebar', ['hide'=>'1']) 


<div class="row" style="padding-top: 30px">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">DATOS PARA GENERAR LISTA DE CUENTAS POR COBRAR</h5>
        
        
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
 

    <div class="container">    
          <div class="row my-3">
            <div class="col">
      
              <p>PERFIL = {{$perfil}}</p>
                <H4>USUARIO:{{$perfil->nombre}} {{$perfil->paterno}} {{$perfil->materno}}</H4>
                <p>USUARIO AUTENTICADO = {{Auth::user()}}</p>
                <p>{{$carta}}</p>
              
     
            </div>
            <div class="col">
              <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalRED">REDACTAR</button>
              <form method="GET" target="_blank" action="{{ route('GeneradorCartas.store') }}">
                <button type="submit" class="btn btn-primary mx-2" name="genPDF" value="export">
                  PDF <i class="fas fa-file-pdf"></i>
              </button>
              <div class="mb-2 row d-flex justify-content-center">
                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Al:</label>
                <div class="col-sm-6">
                <input id="ffin" type="date" class="form-control form-control-sm " name="ffin2" value ="{{date('Y-m-d')}}">
                </div>

                <div class="col-sm-6">
                  <input id="ffinf" type="date" class="form-control form-control-sm " name="ffinf" value ="{{date('Y-m-d')}}">
                  </div>
                  
              </form>
            
            </div>

          </div>
          <table class="cell-border compact hover" id="example" style="width:100%;" >
            <thead>
              <th>Fecha</th>
              <th>Observacion</th>
              <th>Estado</th>
              <th>Accion</th>
    
            </thead>
            <tbody>

           
         @foreach ($carta as $key=>$value)
        @if ($value->userAuth==Auth::user()->id)
        <tr>
            <td>{{$value->created_at}}</td>
            <td>{{$value->Descripcion}}</td>
            <td>{{$value->estado1}}</td>
            @if ($value->estado1==1)
                <td>estado enviado...</td> 
            @endif
            @if ($value->estado1==2)
            <td>
               <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalR">
    Rechazado
  </button>

            </td>
             @endif
            @if ($value->estado1==3)
            <td>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalP" data-bs-whatever="@mdo">Aceptado</button> 

            </td>
                
            @endif
            
            </tr>
        @endif
          
            
         @endforeach
                
           
       
           
         
          </tbody>
   
        </table>        
    </div>      
    <!-- Modal RECHAZADO-->
<!--ventana modal-->
<div class="modal fade" id="exampleModalR" tabindex="-1" aria-labelledby="exampleModalLabelR" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelR">RECHAZADO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
    
<!--modal ACEPTADO-->
<div class="modal fade" id="exampleModalP" tabindex="-1" aria-labelledby="exampleModalLabelP" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelP">New message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>

<!--modal REDACTAR-->
<div class="modal fade" id="exampleModalRED" tabindex="-1" aria-labelledby="exampleModalLabelRED" class="exampleModalRED" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelRED">Redactar carta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
                <div class="container">
                    <div class="row">
                      <div class="col">
                        <label for="recipient-name" class="col-form-label">Señor:</label>
                        <input type="text" class="form-control" id="recipient-name">
                      </div>
                      <div class="col">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                      </div>
                      <div class="col">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                      </div>
                    </div>
                  </div>
          
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
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


<script>
/* 
$( document ).ready(function() {
    $('#exampleModalRED').modal('toggle')
});
*/
</script>
@endsection