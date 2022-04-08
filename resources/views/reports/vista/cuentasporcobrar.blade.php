@extends('layouts.app')
<style>
table.dataTable {
  font-size: 0.9em;
}
.categoria_max
    {
        max-width: 300px !important;
        text-overflow: ellipsis;
    }

.dataTables_scrollBody{
  max-height: 450px !important;
}
</style>
@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <table id="example" class="cell-border compact hover" style="width:100%">
            <tfoot class="table tabll-sm border">
                <tr class="text-right">
                <th colspan = 5></th>
                <th>TOTAL</th>
                <td class="sumTCXC bg-success"></td>
                <td class="sumTCuenta bg-warning"></td>
                <td class="sumTSaldo bg-info"></td>
                <th colspan = 7></th>
                <!--/tr>
                <tr class="text-right">
                <td colspan = 3></td>
                <th colspan = 4 class="text-center">Resumen Cuentas Por Cobrar</th>
                <td colspan = 7></td>
                </tr-->
                
                <tr class="text-right">
                <td colspan = 5></td>
                <td>VIGENTE</td>
                <td class="sumVigenteCXC bg-success"></td>            
                <td class="sumVigenteCuenta bg-warning"></td>
                <td class="sumVigenteSaldo bg-info"></td>
                <td colspan = 7></td>
                </tr>
                <tr class="text-right">
                <td colspan = 5></td>
                <td>VENCIDO</td>
                <td class="sumVencidoCXC bg-success"></td>            
                <td class="sumVencidoCuenta bg-warning"></td>
                <td class="sumVencidoSaldo bg-info"></td>
                <td colspan = 8></td>
                </tr>
                <tr class="text-right">
                <td colspan = 5></td>
                <td>MORA</td>
                <td class="sumMoraCXC bg-success"></td>            
                <td class="sumMoraCuenta bg-warning"></td>
                <td class="sumMoraSaldo bg-info"></td>
                <td colspan = 8></td>
            </tr>
            </tfoot>
            </table>        
        </div>
    </div>
</div>
<button id="actualizar">actualizar  Totales</button>
@endsection

@section('mis_scripts')
<script>
var json_data = {!! json_encode($cxc) !!};
jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
    return this.flatten().reduce( function ( a, b ) {
        if ( typeof a === 'string' ) {
            a = a.replace(/[^\d.-]/g, '') * 1;
        }
        if ( typeof b === 'string' ) {
            b = b.replace(/[^\d.-]/g, '') * 1;
        }
 
        return a + b;
    }, 0 );
} );
$(document).ready(function() 
{  
    
    var height = screen.height-500+'px';
    var table = $('#example').DataTable( 
    {
        data: json_data,
        columns: [
            { data: 'Cod', title: 'Codigo' },
            { data: 'Cliente', title: 'Cliente' },
            { data: 'Rsocial', title: 'Rsocial' },
            { data: 'Nit', title: 'Nit' },
            { data: 'Fecha', title: 'Fecha'},
            { data: 'FechaVenc', title: 'FechaVenc'},
            { data: 'ImporteCXC', title: 'ImporteCXC'},
            { data: 'ACuenta', title: 'ACuenta'},
            { data: 'Saldo', title: 'Saldo'},
            { data: 'FechaCobro', title: 'FechaCobro'},
            { data: 'Glosa', title: 'Glosa'},
            { data: 'Usuario', title: 'Usuario'},
            { data: 'Moneda', title: 'M.'},
            { data: 'NroVenta', title: 'NVenta'},
            { data: 'NroFac', title: 'Num. Fac'},
            { data: 'Local', title: 'Local'},
            { data: 'estado', title: 'estado'},
                /*"render": function (data, row) 
                {
                    if (row === "MORA") 
                    {
                        data = 'MORAS';          
                    }
                }*/        
        ],
        "pageLength": 100,  
        "columnDefs": [
            { className: "dt-right", "targets":[6,7,8]},
            { className: "sum_total", "targets":[6]},
            { className: "categoria_max", "targets":[1,7]}
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
        "scrollX": false,
        "scrollY": height,
        "scrollCollapse": true, 
    } );
    //var sum = table.column(4).data().sum();
    //$("#sum").val(sum);
    function totales() 
    {
        //var sum = table.column(4).data();
        //var tab = table.rows( { selected: true, search: 'applied' } ).data();
        //console.log(tab); 
        var sumTCXC = table.column( 6, {search:'applied'} ).data().sum();
        var sumTCuenta = table.column( 7, {search:'applied'} ).data().sum();
        var sumTSaldo = table.column( 8, {search:'applied'} ).data().sum();
        sumTCXC = Math.round((sumTCXC + Number.EPSILON) * 100) / 100;
        sumTCuenta = Math.round((sumTCuenta + Number.EPSILON) * 100) / 100;
        sumTSaldo = Math.round((sumTSaldo + Number.EPSILON) * 100) / 100;
        $('.dataTables_scrollFootInner .sumTCXC').html(sumTCXC.toFixed(2));
        $('.dataTables_scrollFootInner .sumTCuenta').html(sumTCuenta.toFixed(2));
        $('.dataTables_scrollFootInner .sumTSaldo').html(sumTSaldo.toFixed(2));
        var vigente = table
        .rows({search:'applied'})
        .indexes()
        .filter( function ( value, index ) {
            return 'VIGENTE' === table.row(value).data()['estado'];
        } );
        var vencido = table
        .rows({search:'applied'})
        .indexes()
        .filter( function ( value, index ) {
            return 'VENCIDO' === table.row(value).data()['estado'];
        } );
        var mora = table
        .rows({search:'applied'})
        .indexes()
        .filter( function ( value, index ) {
            return 'MORA' === table.row(value).data()['estado'];
        } );
        sumVigenteCXC = Math.round((table.cells(vigente, 6).data().sum() + Number.EPSILON) * 100) / 100;
        sumVigenteCuenta = Math.round((table.cells(vigente, 7).data().sum() + Number.EPSILON) * 100) / 100;
        sumVigenteCSaldo = Math.round((table.cells(vigente, 8).data().sum() + Number.EPSILON) * 100) / 100;
        $('.dataTables_scrollFootInner .sumVigenteCXC').html(sumVigenteCXC.toFixed(2));
        $('.dataTables_scrollFootInner .sumVigenteCuenta').html(sumVigenteCuenta.toFixed(2));
        $('.dataTables_scrollFootInner .sumVigenteSaldo').html(sumVigenteCSaldo.toFixed(2));

        sumVencidoCXC = Math.round((table.cells(vencido, 6).data().sum() + Number.EPSILON) * 100) / 100;
        sumVencidoCuenta = Math.round((table.cells(vencido, 7).data().sum() + Number.EPSILON) * 100) / 100;
        sumVencidoCSaldo = Math.round((table.cells(vencido, 8).data().sum() + Number.EPSILON) * 100) / 100;
        $('.dataTables_scrollFootInner .sumVencidoCXC').html(sumVencidoCXC.toFixed(2));
        $('.dataTables_scrollFootInner .sumVencidoCuenta').html(sumVencidoCuenta.toFixed(2));
        $('.dataTables_scrollFootInner .sumVencidoSaldo').html(sumVencidoCSaldo.toFixed(2));

        sumMoraCXC = Math.round((table.cells(mora, 6).data().sum() + Number.EPSILON) * 100) / 100;
        sumMoraCuenta = Math.round((table.cells(mora, 7).data().sum() + Number.EPSILON) * 100) / 100;
        sumMoraCSaldo = Math.round((table.cells(mora, 8).data().sum() + Number.EPSILON) * 100) / 100;
        $('.dataTables_scrollFootInner .sumMoraCXC').html(sumMoraCXC.toFixed(2));
        $('.dataTables_scrollFootInner .sumMoraCuenta').html(sumMoraCuenta.toFixed(2));
        $('.dataTables_scrollFootInner .sumMoraSaldo').html(sumMoraCSaldo.toFixed(2));
        
    }
    totales();
    $( '#example_filter label input').on( 'keyup change', function () {
        totales();
    } );
    $( '#example_filter label input').on( 'change', function () {
        totales();
    } );
    setTimeout(function(){
    $(".page-wrapper").removeClass("toggled"); 
 }, 500);
} );
</script>
@endsection
