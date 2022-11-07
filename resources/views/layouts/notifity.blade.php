


  <!-- ventana modal de mensajes -->
 



<!--boton x-->
<div class="claseX" >
  <div class="notify">

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="fas fa-bell"></i>
    </button>
 
  </div>

</div>


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




  <script type="text/javascript">
    var notify = document.querySelector('.notify');
    var btn = document.querySelector('.btn');
    var idX= {{$tamaño}};
 
      $(window).on('load',function(){
        notify.setAttribute('data-count', idX);
      });
    
    //btn.addEventListener('click',active);
    
    
      //$(window).on('load',function(){
       // var add = Number(notify.getAttribute('data-count') || -1);
        //notify.setAttribute('data-count', add + 1);
       // notify.setAttribute('data-count', idX);
       // if(add === 0){
       //     notify.classList.add('add-numb');
      //  }
      //  false;
    //});
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



