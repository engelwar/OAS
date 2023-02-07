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
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Salary</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Salary</th>
          </tr>
        </tfoot>
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
<button id="actualizar">actualizar Totales</button>
@endsection

@section('mis_scripts')
<script>
  var json_data1 = {!!json_encode($movimientos1) !!};
  var json_data2 = {!!json_encode($movimientos2) !!};
  var prueba = {!!json_encode($prueba) !!};
  prueba.forEach(j => {
    console.log(j);
  });
  /* Formatting function for row details - modify as you need */
  function format(d) {
    // Inicializar HTML
    let tabla = `<table cellpadding="5" cellspacing="0" style="border-collapse: separate; border-spacing: 40px 5px;">
         <thead>
         <tr>
            <th>Fecha de Recepción</strong></th>
            <th>No. Factura</th>
            <th>Codigo Art</th>
            <th>Descripcion Art</th>
         </tr>
         </thead>
         <tbody>`;
    // Recorrer facturas para agregar cada fila
    prueba.forEach(i => {
      // prueba[i].vista1.forEach(f => {
      //   tabla += `<tr>
      //         <td>${f.id_cliente_2}</td>
      //         <td>${f.nomb_cliente_2}</td>
      //         <td>${f.id_usuario_2}</td>
      //         <td>${f.nomb_user_2}</td>
      //         <td>${f.local_2}</td>
      //         <td>${f.importeCXC_2}</td>
      //         <td>${f.cont_2}</td>
      //         <td>${f.cred_2}</td>
      //         <td>${f.saldo_2}</td>
      //     </tr>`;
      // });
    });
    tabla += '</tbody></table>';
    return tabla;
  }

  $(document).ready(function() {
    var table = $('#example').DataTable({
        data: prueba,
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },
            { data: 'id_usuario_1' },
            { data: 'nomb_user_1' },
            { data: 'local_1' },
            { data: 'importeCXC_1' },
        ],
        order: [[1, 'asc']],
    });
 
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.dt-control', function () {
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