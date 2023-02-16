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
  <div class=" row d-flex justify-content-center my-3">
    <div class="d-flex align-items-center justify-content-center">
      <h3 class="text-primary">REPORTE DE CUENTAS POR COBRAR TOTAL</h3>
    </div>
  </div>
  <div class="row justify-content-center mt-4">
    <div class="col-md-12">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th></th>
            <th>Usuario</th>
            <th>Local</th>
            <th>ImporteCxC</th>
            <th>Contado</th>
            <th>Credito</th>
            <th>Saldo</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <!-- The Modal -->
  <!-- <div id="myModal" class="modal"> -->
  <!-- Modal content -->
  <!-- <div class="modal-content" style="width: 100% !important; background-color: #e0e0e0;">
      <div class="modal-header">
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
  </div> -->
</div>
@endsection

@section('mis_scripts')
<script>
  var array = {!!json_encode($array) !!};
  /* Formatting function for row details - modify as you need */
  function format(d) {
    // Inicializar HTML
    console.log(d.vista1);
    let tabla = `<table cellpadding="5" cellspacing="0" style="border-collapse: separate; border-spacing: 35px 0px; font-size: 14px; margin-left: 90px;">
           <thead>
           <tr>
              <th>Nombre de Cliente</strong></th>
              <th>ImporteCxC</th>
              <th>Contado</th>
              <th>Credito</th>
              <th>Saldo</th>
           </tr>
           </thead>
           <tbody>`;
    // Recorrer facturas para agregar cada fila
    d.vista1.forEach(element => {
      tabla += `<tr>
              <td>${element.nomb_cliente_2}</td>
              <td>${element.importeCXC_2}</td>
              <td>${element.cont_2}</td>
              <td>${element.cred_2}</td>
              <td>${element.saldo_2}</td>
          </tr>`;
    });
    tabla += '</tbody></table>';
    return tabla;
  }

  $(document).ready(function() {
    var table = $('#example').DataTable({
      data: array,
      columns: [{
          className: 'dt-control',
          orderable: false,
          data: null,
          defaultContent: '',
        },
        {
          data: 'nomb_user_1'
        },
        {
          data: 'local_1'
        },
        {
          data: 'importeCXC_1'
        },
        {
          data: 'cont_1'
        },
        {
          data: 'cred_1'
        },
        {
          data: 'saldo_1'
        },
      ],
      order: [
        [1, 'asc']
      ],
    });

    // Add event listener for opening and closing details
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