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
      <table id="example" class="cell-border compact hover" style="width:100%">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>ValorDeVentas</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>CostoDeVentas</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>MargenDeUtilidad</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Margen%Utilidad</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th>Marca</th>
            <th>Prod</th>
            <th>Descrip</th>
            <th>Costo</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>InstiSucursal</th>
            <th>PDV</th>
            <th>Institucional</th>
            <th>Mayorista</th>
            <th>Total</th>
            <th>StockValorado</th>
            <th>InstiSucursal</th>
            <th>PDV</th>
            <th>Institucional</th>
            <th>Mayorista</th>
            <th>Total</th>
            <th>InstiSucursal</th>
            <th>PDV</th>
            <th>Institucional</th>
            <th>Mayorista</th>
            <th>Total</th>
            <th>InstiSucursal</th>
            <th>PDV</th>
            <th>Institucional</th>
            <th>Mayorista</th>
            <th>Total</th>
          </tr>
        </thead>
        <tfoot>
          @foreach ($tituloVista as $ti)
          <th @if(isset($ti['tip']))class="{{$ti['tip']}}" @endif>@if(isset($ti['tip']) && $ti['tip'] == 'filtro'){{$ti['title']}}@endif</th>
          @endforeach
        </tfoot>
      </table>
    </div>
  </div>
</div>
@endsection

@section('mis_scripts')
<script>
  var json_data = {!!json_encode($ini) !!};
  var titulos = {!!json_encode($tituloVista) !!};
  var fini = new Date({!!json_encode($fini_format) !!});
  var ffin = new Date({!!json_encode($ffin_format) !!});
  var date_comp = new Date("03-01-2021");
  if (fini.getTime() < date_comp.getTime() && ffin.getTime() < date_comp.getTime()) {
    var columna_datos = [{
        name: 'marca',
        data: 'marca',
        title: 'Marca',
        tip: 'filtro'
      },
      {
        name: 'prod',
        data: 'prod',
        title: 'Prod',
        tip: 'filtro'
      },
      {
        name: 'descrip',
        data: 'descrip',
        title: 'Descrip',
        tip: 'filtro'
      },
      {
        name: 'costo',
        data: 'costo',
        title: 'Costo',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'precio',
        data: 'precio',
        title: 'Precio',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'cantidad',
        data: 'cantidad',
        title: 'Cantidad'
      },
      {
        name: 'INS_tot',
        data: 'INS_tot',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_tot',
        data: 'INS_SUC_tot',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_tot',
        data: 'MAYO_tot',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_tot',
        data: 'PDV_tot',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total',
        data: 'total',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'StockValorado',
        data: 'StockValorado',
        title: 'StockValorado',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_can_costo',
        data: 'INS_can_costo',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_can_costo',
        data: 'INS_SUC_can_costo',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_can_costo',
        data: 'MAYO_can_costo',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_can_costo',
        data: 'PDV_can_costo',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'cantidadxcosto',
        data: 'cantidadxcosto',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_totmargenutilidad',
        data: 'INS_totmargenutilidad',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_totmargenutilidad',
        data: 'INS_SUC_totmargenutilidad',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_totmargenutilidad',
        data: 'MAYO_totmargenutilidad',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_totmargenutilidad',
        data: 'PDV_totmargenutilidad',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total_margen',
        data: 'total_margen',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_totmargenutilidad_porc',
        data: 'INS_totmargenutilidad_porc',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_totmargenutilidad_porc',
        data: 'INS_SUC_totmargenutilidad_porc',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_totmargenutilidad_porc',
        data: 'MAYO_totmargenutilidad_porc',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_totmargenutilidad_porc',
        data: 'PDV_totmargenutilidad_porc',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total_margen_proc',
        data: 'total_margen_proc',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
    ];
  } else if (fini.getTime() >= date_comp.getTime() && ffin.getTime() >= date_comp.getTime()) {
    var columna_datos = [{
        name: 'maconNomb',
        data: 'maconNomb',
        title: 'Marca',
        tip: 'filtro'
      },
      {
        name: 'prod',
        data: 'prod',
        title: 'Prod',
        tip: 'filtro'
      },
      {
        name: 'descrip',
        data: 'descrip',
        title: 'Descrip',
        tip: 'filtro'
      },
      {
        name: 'inumeDesc',
        data: 'inumeDesc',
        title: 'U.M.',
        tip: 'filtro'
      },
      {
        name: 'costo',
        data: 'costo',
        title: 'Costo',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'precio',
        data: 'precio',
        title: 'Precio',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'cantidad',
        data: 'cantidad',
        title: 'Cantidad'
      },
      {
        name: 'INS_tot',
        data: 'INS_tot',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_tot',
        data: 'INS_SUC_tot',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_tot',
        data: 'MAYO_tot',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_tot',
        data: 'PDV_tot',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total',
        data: 'total',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'StockValorado',
        data: 'StockValorado',
        title: 'StockValorado',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_costo',
        data: 'INS_costo',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_costo',
        data: 'INS_SUC_costo',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_costo',
        data: 'MAYO_costo',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_costo',
        data: 'PDV_costo',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'cantidadxcosto',
        data: 'cantidadxcosto',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INSmargenutilidad',
        data: 'INSmargenutilidad',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUCmargenutilidad',
        data: 'INS_SUCmargenutilidad',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYOmargenutilidad',
        data: 'MAYOmargenutilidad',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDVmargenutilidad',
        data: 'PDVmargenutilidad',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total_margen',
        data: 'total_margen',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INSmargenutilidad_porc',
        data: 'INSmargenutilidad_porc',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUCmargenutilidad_porc',
        data: 'INS_SUCmargenutilidad_porc',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYOmargenutilidad_porc',
        data: 'MAYOmargenutilidad_porc',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDVmargenutilidad_porc',
        data: 'PDVmargenutilidad_porc',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total_margen_proc',
        data: 'total_margen_proc',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
    ];
  } else {
    var columna_datos = [{
        name: 'marca',
        data: 'marca',
        title: 'Marca',
        tip: 'filtro'
      },
      {
        name: 'prod',
        data: 'prod',
        title: 'Prod',
        tip: 'filtro'
      },
      {
        name: 'descrip',
        data: 'descrip',
        title: 'Descrip',
        tip: 'filtro'
      },
      {
        name: 'costo',
        data: 'costo',
        title: 'Costo',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'precio',
        data: 'precio',
        title: 'Precio',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'cantidad',
        data: 'cantidad',
        title: 'Cantidad'
      },
      {
        name: 'INS_tot',
        data: 'INS_tot',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_tot',
        data: 'INS_SUC_tot',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_tot',
        data: 'MAYO_tot',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_tot',
        data: 'PDV_tot',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total',
        data: 'total',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'StockValorado',
        data: 'StockValorado',
        title: 'StockValorado',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_can_costo',
        data: 'INS_can_costo',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_can_costo',
        data: 'INS_SUC_can_costo',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_can_costo',
        data: 'MAYO_can_costo',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_can_costo',
        data: 'PDV_can_costo',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'cantidadxcosto',
        data: 'cantidadxcosto',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_totmargenutilidad',
        data: 'INS_totmargenutilidad',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_totmargenutilidad',
        data: 'INS_SUC_totmargenutilidad',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_totmargenutilidad',
        data: 'MAYO_totmargenutilidad',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_totmargenutilidad',
        data: 'PDV_totmargenutilidad',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total_margen',
        data: 'total_margen',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_totmargenutilidad_porc',
        data: 'INS_totmargenutilidad_porc',
        title: 'InstiSucursal',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'INS_SUC_totmargenutilidad_porc',
        data: 'INS_SUC_totmargenutilidad_porc',
        title: 'PDV',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'MAYO_totmargenutilidad_porc',
        data: 'MAYO_totmargenutilidad_porc',
        title: 'Institucional',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'PDV_totmargenutilidad_porc',
        data: 'PDV_totmargenutilidad_porc',
        title: 'Mayorista',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
      {
        name: 'total_margen_proc',
        data: 'total_margen_proc',
        title: 'Total',
        render: $.fn.dataTable.render.number(',', '.', 2)
      },
    ];
  }
  $(document).ready(function() {
    $('#example tfoot th').each(function() {
      if ($(this).hasClass('filtro')) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="' + title + '" style="width:100%;"/>');
      }
    });
    $('#example').DataTable({
      data: json_data,
      columns: columna_datos,
      "pageLength": 50,
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
      dom: 'Bfrtip',
      buttons: [{
        extend: "excel",
        text: "Exportar en Excel"
      }],
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