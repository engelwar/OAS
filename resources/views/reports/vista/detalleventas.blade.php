@extends('layouts.app')
@section('estilo')

<style>
  .categoria_max {
    max-width: 120px !important;
    text-overflow: ellipsis;
  }
</style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0'])
<div class="container-fluid">
  <div class="row justify-content-center mt-4">
    <div class="col">
      <table id="example" class="table" style="width:100%">
        <thead>
          <tr>
            <th>NTran</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Almacen</th>
            <th>Factura</th>
            <th>ImpTotal</th>
            <th>DesTotal</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($query as $key => $value)
          <tr class="text-white" style="background-color: #355296;">
            <td>{{$value->vtvtaNtra}}</td>
            <td>{{$value->fecha}}</td>
            <td>{{$value->adusrNomb}}</td>
            <td>{{$value->inalmNomb}}</td>
            <td>{{$value->factura}}</td>
            <td>{{$value->imptotal}}</td>
            <td>{{$value->destotal}}</td>
            <td>{{$value->total}}</td>
          </tr>
          @foreach ($array_data[$value->vtvtaNtra] as $i => $j)
          <tr>
            <!-- <td colspan="2"></td> -->
            <td></td>
            <td></td>
            <td>{{$j->vtvtdCpro}}</td>
            <td>{{$j->descripcion}}</td>
            <td>{{$j->inumeAbre}}</td>
            <td>{{$j->imptotal}}</td>
            <td>{{$j->destotal}}</td>
            <td>{{$j->total}}</td>
          </tr>
          @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('mis_scripts')
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.2/js/buttons.html5.styles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.2/js/buttons.html5.styles.templates.min.js"></script>
<script>
  // var json_data = {!!json_encode($query) !!};
  $(document).ready(function() {
    $('#example tfoot th').each(function() {
      if ($(this).hasClass('filtro')) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="' + title + '" style="width:100%;"/>');
      }
    });
    $('#example').DataTable({
      paging: false,
      order: false,
      dom: 'Bfrtip',
      buttons: {
        dom: {
          button: {
            className: 'btn'
          }
        },
        buttons: [{
          extend: "excel",
          text: 'Exportar a Excel',
          className: 'btn btn-outline-primary mb-4',
        }]
      },
      // data: json_data,
      // columns: [
      //   {
      //     data: 'vtvtaNtra',
      //     title: 'NTran'
      //   },
      //   {
      //     data: 'fecha',
      //     title: 'Fecha'
      //   },
      //   {
      //     data: 'adusrNomb',
      //     title: 'Usuario'
      //   },
      //   {
      //     data: 'inalmNomb',
      //     title: 'Almacen'
      //   },
      //   {
      //     data: 'imptotal',
      //     title: 'ImpTotal'
      //   },
      //   {
      //     data: 'destotal',
      //     title: 'DesTotal'
      //   },
      //   {
      //     data: 'total',
      //     title: 'Total'
      //   },
      //   {
      //     data: 'factura',
      //     title: 'Factura'
      //   }
      // ],
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
      "scrollX": true,
      "scrollY": "60vh",
      "scrollCollapse": true,
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
    $(".page-wrapper").removeClass("toggled");
  });
</script>
@endsection