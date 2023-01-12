@extends('layouts.app')
<style>
  table.dataTable {
    font-size: 0.9em;
  }

  .categoria_max {
    max-width: 300px !important;
    text-overflow: ellipsis;
  }

  .dataTables_scrollBody {
    max-height: 450px !important;
  }
</style>
@section('content')
@include('layouts.sidebar', ['hide'=>'0'])


<div class="container-fluid">
  <div class="row justify-content-center mt-4">
    <div class="col-md-12">
      <table id="example" class="cell-border compact hover" style="width:100%;">
        <tfoot>
          @foreach ($titulos as $ti)
          <th @if(isset($ti['tip']))class="{{$ti['tip']}}" @endif>@if(isset($ti['tip']) && $ti['tip'] == 'filtro'){{$ti['title']}}@endif</th>
          @endforeach
        </tfoot>
      </table>
    </div>
  </div>
  <!-- The Modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 100% !important; background-color: #e0e0e0;">
      <div class="modal-header">
        <!-- <h6 class="modal-title"></h6> -->
        <span class="close h5">&times;</span>
      </div>
      <div class="modal-body">
        <table id="table_detalle" class="cell-border compact hover" style="width:100%">
          <thead>
            <tr>
              <td>FechaNR</td>
              <td>NR</td>
              <td>Cliente</td>
              <td>FechaFac</td>
              <td>NroFac</td>
              <td>Glosa</td>
              <td>RazonSocial</td>
              <td>NIT</td>
              <td>ImpTotal</td>
              <td>FechaACuenta</td>
              <td>Contado</td>
              <td>Credito</td>
              <td>Usuario</td>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<button id="actualizar">actualizar Totales</button>
@endsection

@section('mis_scripts')
<script>
  var json_data = {!!json_encode($movimientos) !!};
  jQuery.fn.dataTable.Api.register('sum()', function() {
    return this.flatten().reduce(function(a, b) {
      if (typeof a === 'string') {
        a = a.replace(/[^\d.-]/g, '') * 1;
      }
      if (typeof b === 'string') {
        b = b.replace(/[^\d.-]/g, '') * 1;
      }

      return a + b;
    }, 0);
  });
  $(document).ready(function() {
    $('#example tfoot th').each(function() {
      if ($(this).hasClass('filtro')) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="' + title + '" style="width:100%;"/>');
      }
    });
    var height = screen.height - 500 + 'px';
    var table = $('#example').DataTable({
      data: json_data,
      columns: [{
          data: 'Cliente',
          title: 'Cliente'
        },
        {
          data: 'Rsocial',
          title: 'RazonSocial'
        },
        {
          data: 'Nit',
          title: 'NIT'
        },
        {
          data: 'adusrNomb',
          title: 'Usuario'
        },
        {
          data: 'inlocNomb',
          title: 'Local'
        },
        {
          data: 'cont',
          title: 'Contado'
        },
        {
          data: 'cred',
          title: 'Credito'
        },
      ],
      "pageLength": 100,
      "columnDefs": [{
          "targets": 0,
          "render": function(data, type, row, meta) {
            var link = '<a class="enlace_cuenta" id ="' + data + '" style="cursor:pointer;">' + data + '</a>'
            return link;
          }
        },
        {
          className: "dt-right",
          "targets": [5, 6]
        },
        // {
        //   className: "sum_total",
        //   "targets": [6]
        // },
        // {
        //   className: "categoria_max",
        //   "targets": [1, 7]
        // }
      ],
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
      "scrollX": false,
      "scrollY": height,
      "scrollCollapse": true,
      dom: 'Bfrtip',
      buttons: [{
        extend: "excel",
        text: "Exportar en Excel"
      }, ],
      // initComplete: function(){
      //   this.api().columns().every(function() {
      //     if ($(this.header()).hasClass("filtro")) {
      //       var that = this;
      //       $('input', this.header()).on('keyup change clear', function() {
      //         if (that.search() !== this.value) {
      //           that
      //             .search(this.value)
      //             .draw();
      //         }
      //       });
      //     }
      //   });
      // }
      initComplete: function() {
        // Apply the search
        this.api().columns().every(function() {
          if ($(this.footer()).hasClass("filtro_select")) {
            var column = this;
            var select =
              $('<select class="form-select form-select-sm" style="background-image:none;padding-right:8px;width:auto"><option value="" class="text-secondary">TODOS</option></select>')
              .appendTo($(column.footer()).empty())
              .on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex(
                  $(this).val()
                );

                column
                  .search(val ? '^' + val + '$' : '', true, false)
                  .draw();
              });

            column.data().unique().sort().each(function(d, j) {
              select.append('<option value="' + d + '">' + d + '</option>')
            });
          } else if ($(this.footer()).hasClass("filtro")) {
            var that = this;
            $('input', this.footer()).on('keyup change clear', function() {
              if (that.search() !== this.value) {
                that
                  .search(this.value)
                  .draw();
              }
            });
          }
        });
      }
    });
    //var sum = table.column(4).data().sum();
    //$("#sum").val(sum);
    setTimeout(function() {
      $(".page-wrapper").removeClass("toggled");
    }, 500);
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
      $('#myModal').fadeOut();
    }
    table.on('click', 'a.enlace_cuenta', function() {
      console.log("TEST");
      var id = $(this).attr('id');

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('cuentasporcobrardetalletotal.store')}}",
        type: 'POST',
        dataType: 'json',
        data: {
          id
        },
        paging: false,
        success: function(data) {
          // Get the modal}
          $('#table_detalle').DataTable().clear();
          $('#table_detalle').DataTable().destroy();
          $('#table_detalle').DataTable({
            data: data.detalle,
            columns: [
              // { data: 'liqdCNtcc'},
              // { data: 'liqdcImpC',render: $.fn.dataTable.render.number( ',', '.', 2)},
              // { data: 'liqdCAcmt',render: $.fn.dataTable.render.number( ',', '.', 2)},
              // { data: 'liqXCGlos'},
              // { data: 'Fecha'}
              {
                data: 'fechaNR'
              },
              {
                data: 'vtvtaNtra'
              },
              {
                data: 'Cliente'
              },
              {
                data: 'fechaFC'
              },
              {
                data: 'imLvtNrfc'
              },
              {
                data: 'Glosa'
              },
              {
                data: 'Rsocial'
              },
              {
                data: 'Nit'
              },
              {
                data: 'ImporteCXC'
              },
              {
                data: 'fechaAC'
              },
              {
                data: 'cont'
              },
              {
                data: 'cred'
              },
              {
                data: 'adusrNomb'
              },
            ],
            dom: 'Bfrtip',
            buttons: [{
              extend: "excel",
              text: "Exportar en Excel"
            }],
            "columnDefs": [
              {
                className: "dt-right",
                "targets": [10, 11]
              },
            ],
          });
          $('#myModal').fadeIn();

        },
        error: function(data) {
          console.log(data);
        }
      });
    });
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == document.getElementById('myModal')) {
        $('#myModal').fadeOut();
      }
    }
  });
</script>
@endsection