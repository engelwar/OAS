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
  .dt-right{
    text-align: right;
  }
</style>
@section('content')
@include('layouts.sidebar', ['hide'=>'0'])
<div class="container-fluid">
  <div class="row justify-content-center mt-4">
    <div class="col-md-12">
      <table id="example" class="cell-border compact hover" style="width:100%">
      </table>
    </div>
  </div>
@endsection
@section('mis_scripts')
<script>
  var json_data = {!!json_encode($array)!!};
  function format(d) {
    // Inicializar HTML
    console.log(d.vista1);
    let tabla = `<table cellpadding="5" cellspacing="0" style="font-size: 14px; margin-left: 90px;">
           <thead>
           <tr>
              <th>Categoria</strong></th>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>U.M.</th>
              <th>ImpUnitario</th>
              <th>Cantidad</th>
              <th>Importe</th>
              <th>Descuento</th>
              <th>Descuento%</th>
              <th>ImporteTotal</th>
           </tr>
           </thead>
           <tbody>`;
    d.vista1.forEach(element => {
      tabla += `<tr>
              <td>${element.maconNomb}</td>
              <td>${element.inproCpro}</td>
              <td>${element.inproNomb}</td>
              <td>${element.inumeAbre}</td>
              <td class="dt-right">${element.ImpU}</td>
              <td class="dt-right">${element.vtvtdCant}</td>
              <td class="dt-right">${element.ImpT}</td>
              <td class="dt-right">${element.DesT}</td>
              <td class="dt-right">${element.DesPor}</td>
              <td class="dt-right">${element.total}</td>
          </tr>`;
    });
    tabla += '</tbody></table>';
    return tabla;
  }
  $(document).ready(function() {
    var height = screen.height - 500 + 'px';
    var table = $('#example').DataTable({
      data: json_data,
      columns: [
        {
          className: 'dt-control',
          orderable: false,
          data: null,
          defaultContent: '',
        },
        {
          data: 'vtvtaNtra',
          title: 'NTransaccion'
        },
        {
          data: 'fecha',
          title: 'Fecha'
        },
        {
          data: 'vtvtaNomC',
          title: 'NomCliente'
        },
        {
          data: 'imLvtRsoc',
          title: 'RazonSocial'
        },
        {
          data: 'imLvtNNit',
          title: 'Nit'
        },
        {
          data: 'factura',
          title: 'Factura'
        },
        {
          data: 'ImpT',
          title: 'ImpTotal'
        },
        {
          data: 'DesPor',
          title: '%Descuento'
        },
        {
          data: 'DesT',
          title: 'DesTotal'
        },
        {
          data: 'total',
          title: 'Total'
        },
        {
          data: 'adusrNomb',
          title: 'Usuario'
        },
        {
          data: 'inalmNomb',
          title: 'Almacen'
        },
      ],
      "pageLength": 100,
      "columnDefs": [
        // {
        //   "targets": 0,
        //   "render": function(data, type, row, meta) {
        //     var link = '<a class="enlace_cuenta" id ="' + data + '" style="cursor:pointer;">' + data + '</a>'
        //     return link;
        //   }
        // },
        {
          className: "dt-right",
          "targets": [1, 2, 3, 4]
        },
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
      // "ordering": false,
      // dom: 'Bfrtip',
      // buttons: {
      //   dom: {
      //     button: {
      //       className: 'btn'
      //     }
      //   },
      //   buttons: [{
      //     extend: "excel",
      //     text: 'Exportar a Excel',
      //     className: 'btn btn-outline-primary mb-4',
      //     excelStyles: {                      
      //           cells: [2,4,5,12,16,20,24,27,35,41,44,47],                     
      //           style: {                      
      //               font: {                     
      //                   name: "Arial",         
      //                   size: "12",         
      //                   color: "FFFFFF",       
      //                   b: false,             
      //               },
      //               fill: {                     
      //                   pattern: {              
      //                       color: "548236",   
      //                   }
      //               }
      //           }
      //       },
      
      //   }]
      // },
      // "aLengthMenu": [100],
      // "paging": false,
      // "info": false,
      // searching: false,
    });
    $('#example tbody').on('click', 'td.dt-control', function() {
      var tr = $(this).closest('tr');
      var row = table.row(tr);

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      } else {
        // Open this row
        row.child(format(row.data())).show();
        tr.addClass('shown');
      }
    });
    $(".page-wrapper").removeClass("toggled");
  });
</script>
@endsection