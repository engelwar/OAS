@extends('layouts.app')
@section('estilo')

<style>
    .categoria_max
    {
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
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha NR</th>
                        <th>NR</th>
                        <th>Cliente</th>
                        <th>Fecha factura</th>
                        <th>Razon social</th>
                        <th>Nit</th>
                        <th>Fecha al contado</th>
                        <th>Monto al contado</th>
                        <th>Fecha credito</th>
                        <th>Monto credito</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>02/02/2023</td>
                        <td>1000000</td>
                        <td>ramos ramos ramon</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto enim debit</td>
                        <td>113245000</td>
                        <td>01/01/2023</td>
                        <td>10</td>
                        <td>03/03/2023</td>
                        <td>100</td>
                        <td>otro usuario</td>
                    </tr>
                    <tr>
                        <td>02/02/2023</td>
                        <td>1000000</td>
                        <td>ramos ramos ramon</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto enim debit</td>
                        <td>113245000</td>
                        <td>01/01/2023</td>
                        <td>10</td>
                        <td>03/03/2023</td>
                        <td>100</td>
                        <td>otro usuario</td>
                    </tr>
                    <tr>
                        <td>02/02/2023</td>
                        <td>1000000</td>
                        <td>ramos ramos ramon</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto enim debit</td>
                        <td>113245000</td>
                        <td>01/01/2023</td>
                        <td>10</td>
                        <td>03/03/2023</td>
                        <td>100</td>
                        <td>otro usuario</td>
                    </tr>
                    <tr>
                        <td>02/02/2023</td>
                        <td>1000000</td>
                        <td>felipe garcia</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto enim debit</td>
                        <td>1132345000</td>
                        <td>01/01/2023</td>
                        <td>50</td>
                        <td>10/03/2023</td>
                        <td>10010</td>
                        <td>otro usuario1</td>
                    </tr>
                    <tr>
                        <td>03/03/2023</td>
                        <td>1020000</td>
                        <td>ramos ramos ramon</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto enim debit</td>
                        <td>11324520</td>
                        <td>01/01/2023</td>
                        <td>100</td>
                        <td>03/03/2023</td>
                        <td>100</td>
                        <td>otro usuario2</td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <th ></th>
                    <th>NR</th>
                    <th>Cliente</th>
                    <th>Fecha factura</th>
                    <th>Razon social</th>
                    <th>Nit</th>
                    <th>Fecha al contado</th>
                    <th>Monto al contado</th>
                    <th>Fecha credito</th>
                    <th>Monto credito</th>
                    <th>Usuario</th>
                </tfoot>
            </table>  
        </div>
    </div>
</div>
@endsection

@section('mis_scripts')
<script>
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });
 
    // DataTable
    var table = $('#example').DataTable({
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
    });
});
$(".page-wrapper").removeClass("toggled"); 
</script>
@endsection
