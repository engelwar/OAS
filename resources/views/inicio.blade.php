@extends('layouts.app')
@section('static', 'statick-side')


@section('estilo')
<style>
  
.claseX {
    position: absolute;
    right: 20%;
    top: 5%;
    transform: translate(-50%,-50%);
    font-family: arial;
    text-align: center;
}

.claseX .bx {
    background: linear-gradient(45deg,#f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f09433',endColorstr='#bc1888',GradientType=1);
    font-size: 150px;
    border-radius: 35%;
    color: white;
}

.claseX .notify::before {
    position: absolute;
    content: attr(data-count);
    top: 90%;
    right: 90%;
    font-size: 20px;
    font-weight: bold;
    color: #fff;
    padding: 3px 15px;
    background: linear-gradient(#ff1a1a,#ff0000,#e60000);
    border-radius: 50px;
    line-height: 100%;
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    transition: opacity 0.1s ease-out;
}

.claseX .btn {
    position: absolute;
    left: 15px;
    top: 10px;
 
    outline: none;
    cursor: pointer;
}

.claseX .btn:hover {
    background: #161d6a;
}

.notify.add-numb::before {
    opacity: 1;
}
</style>
@endsection



@section('content') 
@include('layouts.sidebar', ['hide'=>'0'])
<!--boton x-->
<div class="claseX" >
  <div class="notify"> 
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="fas fa-desktop"></i>
    </button>
 
  </div>
</div>

<div class="container-fluid px-5"> 
  @foreach(App\Modulo::get() as $mod)
  <div class="my-4">
    @if(Auth::user()->tieneModulo($mod->id))
        <h4>
          @if($mod->icon)
         
          <i class="{{$mod->icon}}"></i>
          @else
          <i class="fab fa-ethereum"></i>
          @endif
          <span>{{$mod->nombre}}</span>
        </h4>
        <div class="row">
        @foreach($mod->programs as $prog)
          @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && !$prog->sub_modulo_id)
          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 p-3">
            <a href="{{route($prog->route)}}">
              <div class="card">
                <div class="card-body text-center">
                  <h5 class="card-title"><i class="{{$prog->icon}}"></i></h5>           
                  {{$prog->nombre}}
                </div>
              </div> 
            </a>         
          </div>
          @endif
        @endforeach 
        </div>
        @foreach($mod->submodulos as $submod)
        @if(Auth::user()->tieneSubModulo($submod->id))
          <div class="row col my-2">
            <h5>
              <span>{{$submod->nombre}}</span>
            </h5>
          </div>
          <div class="row ">
            @foreach($submod->programs as $prog)
              @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && $prog->sub_modulo_id)
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 p-3">
                  <a href="{{route($prog->route)}}">
                    <div class="card" style="height:100%;">
                      <div class="card-body text-center">
                        <h5 class="card-title"><i class="{{$prog->icon}}"></i></h5>   
                        {{$prog->nombre}}        
                      </div>                        
                    </div>
                  </a>         
                </div>
              @endif
            @endforeach 
          </div>
        @endif
        @endforeach                                                
    @endif
  </div>
  @endforeach
  </div>
  <!-- ventana modal de mensajes -->
          <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ventana de alerta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
        <div class="container-fluid">
          <div class="row justify-content-center mt-4">
              <div class="col-md-12">
                  <table id="example" class="cell-border compact hover" style="width:100%"></table>        
              </div>
          </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>   

@endsection
@section('mis_scripts')
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });



</script>

<script>
var json_data = {!! json_encode($msnX) !!};


$(document).ready(function() 
{  
    var height = screen.height-430+'px';
    $('#example').DataTable( 
    {
        data: json_data,
        columns: [
          { data: 'Cod', title: 'Codigo'  },
            { data: 'Cliente', title: 'Cliente'  },
            { data: 'Rsocial', title: 'Rsocial'  },
            { data: 'Nit', title: 'NIT'  },
            { data: 'Fecha', title: 'Fecha'  },
            { data: 'FPrimP', title: 'FechaV' },
            { data: 'ImporteCXC', title: 'Importe'  },
            { data: 'ACuenta', title: 'ACuenta'  },
            { data: 'Saldo', title: 'Saldo'  },
          
            { data: 'Local', title: 'Local'  },
        ],
        "pageLength": 15,  
        "columnDefs": [
            { "width": "300px", "targets": 2 }
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
        "scrollX": true,
        "scrollY": height,
        "scrollCollapse": true, 
    } );
  });
   


</script>
<script>
var notify = document.querySelector('.notify');
var btn = document.querySelector('.btn');
btn.addEventListener('click',active);

function active() {

    var add = Number(notify.getAttribute('data-count') || -1);
    notify.setAttribute('data-count', add + 1);
    if(add === 0){
        notify.classList.add('add-numb');
    }
    false;
}
</script>
@endsection