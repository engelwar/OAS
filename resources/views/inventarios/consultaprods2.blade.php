@extends('layouts.app')
@section('estilo')
<style>
  .typeahead.dropdown-menu {
    position: absolute;
  }

  .autocompletar {
    position: relative;
    display: inline-block;
  }

  .autocompletar-content {
    display: block;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 200px;
    max-width: 500px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    border: solid 1px #aaa;
    padding: 5px 1px;
    z-index: 1;
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
    margin-top: 2px;
  }

  .autocompletar-result {
    border-bottom: #c9c9c9 1px solid;
    padding: 8px 10px;
    cursor: pointer;
  }

  .autocompletar-result:hover {
    background-color: #e9e9e9;
  }

  .completar:focus {
    background-color: #ff0000;
  }

  .btn-outline-primary.odoo_hov:hover {
    background-color: #5c3266 !important;
    color: #ffffff !important;
  }

  .btn-check:checked+.btn-outline-primary.odoo_hov,
  .btn-check:active+.btn-outline-primary.odoo_hov,
  .btn-outline-primary.odoo_hov:active,
  .btn-outline-primary.odoo_hov.active,
  .btn-outline-primary.odoo_hov.dropdown-toggle.show {
    background-color: #5c3266 !important;
    color: #ffffff !important;
  }

  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  /* The Modal (background) */
  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 22%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
  }

  /* Add Animation */
  @-webkit-keyframes animatetop {
    from {
      top: -300px;
      opacity: 0
    }

    to {
      top: 0;
      opacity: 1
    }
  }

  @keyframes animatetop {
    from {
      top: -300px;
      opacity: 0
    }

    to {
      top: 0;
      opacity: 1
    }
  }

  /* The Close Button */
  .close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }

  .modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
    height: 40px;
  }

  .modal-body {
    padding: 2px 16px;
  }

  .modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
  }

  /* Modal Content */


  #precio_retail {
    border: none;
    font-size: 35px;
    padding-left: 74px;
    color: black;
  }

  #ovalo {
    padding-top: 7px;
    width: 276px;
    height: 110px;
    background: rgb(233 236 239);
    border-radius: 100px/50px;
  }

  .inputrasparente {
    background: inherit;
    background-color: transparent;
  }
</style>
<script>

</script>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0'])
<div class="container-fluid px-4 mt-5" style="height:100hw">
  <div class="row d-flex justify-content-center" style="height: 50vh">
    <div class="col-12">
      <div class="input-group">
        <input type="text" class="form-control form-control-lg" id="buscar" placeholder="Buscar...">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
      </div>
      <table id="productos" class="display cell-border responsive compact mt-2" style="width:100%;font-size:1.3rem;"></table>
    </div>
  </div>
  <!-- The Modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content overflow-hidden">
      <div class="modal-header">
        <h5 id="title_prod" class="modal-title"></h5>
        <span class="close h5">&times;</span>
      </div>
      <div class="modal-body">
        <h3 id="precio" class="text-center"></h3>
      </div>
    </div>
  </div>
</div>


<div class="w-25 d-flex p-4 text-center m-auto">

  <div id="ovalo">
    <h2>PRECIO</h2>
    <div id="diDer">
      <input id="precio_retail" type="text" value="" class="inputrasparente" disabled>
    </div>
  </div>


</div>
@endsection
@section('mis_scripts')
<script>
  $(document).ready(function() {
    $('#productos tfoot th').each(function() {
      if ($(this).hasClass('filtro')) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="' + title + '" style="width:100%;"/>');
      }
    });
    document.getElementById("buscar").addEventListener("keyup", function() {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('invconsult.store')}}",
        type: 'POST',
        dataType: 'json',
        data: {
          buscar: $("#buscar").val()
        },
        dataType: 'json',
        success: function(data) {
          $('#precio_retail').val('Bs. ' + data["data"][0]["retail"]);
        },
        // error: function (data) {
        //     console.log(data);
        // }
      });
    });
    $('#productos').DataTable({
      searching: true,
      info: false,
      ordering: false,
      pageLength: 150,
      "language": {
        "emptyTable": "Tabla Vacia",
        "info": "Se muestran del _START_ al _END_ de _TOTAL_ registros",
        "infoEmpty": "Se muestran del 0 al 0 de 0 Registros",
        "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
        "lengthMenu": "Se muestran _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontro ningun registro",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },
      "columnDefs": [{
        "targets": 1,
        "render": function(data, type, row, meta) {
          var link = '<a class="enlace_codprod" id ="' + data + '" style="cursor:pointer;">' + data + '</a>'
          return link;
        }
      }, ],
      ajax: {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('invconsult.store')}}",
        type: "post",
        data: function(d) {
          d.buscar = $('#buscar').val();
        },
        dataType: 'json',
        // success: function (data) {
        //     console.log(data);
        // },
        // error: function (data) {
        //     console.log(data);
        // }
      },
      columns: [{
          data: 'marca',
          title: 'MARCA'
        },
        {
          data: 'prod',
          title: 'CODIGO'
        },
        {
          data: 'descrip',
          title: 'DESCRIPCION'
        },
        {
          data: 'um',
          title: 'UM'
        },
        {
          data: 'BarCod',
          title: 'COD.BARRA'
        }
      ],
      scrollY: "70vh",
      scrollX: true,
      scrollCollapse: true,
      dom: 'rtip',
    });
    $("#buscar").on('keyup', function() {
      $('#productos').DataTable().ajax.reload();
    });
    $("#buscar").focus();
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
      $('#myModal').fadeOut();
    };
    $('#productos').on('click', 'a.enlace_codprod', function() {
      var id = $(this).attr('id');
      console.log(id);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('invconsultdetalle.store')}}",
        type: 'POST',
        dataType: 'json',
        data: {
          id
        },
        paging: false,
        success: function(data) {
          // Get the modal}
          console.log(data);
          $('#title_prod').text(data["detalle"][0]["prod"]);
          $('#precio').text('Bs. ' + data["detalle"][0]["retail"]);
          $('#myModal').fadeIn();

        },
        error: function(data) {
          console.log(data);
        }
      });
    });
    $(".page-wrapper").removeClass("toggled");
  });
</script>
@endsection