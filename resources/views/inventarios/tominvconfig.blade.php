@extends('layouts.app')
@section('estilo')
<style>
.typeahead.dropdown-menu 
{
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
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    border: solid 1px #aaa;
    padding: 5px 1px;
    z-index: 1;
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
    margin-top: 2px;
}
.autocompletar-result{
    border-bottom: #c9c9c9 1px solid;
    padding: 8px 10px;
    cursor: pointer;
}
.autocompletar-result:hover{
    background-color: #e9e9e9;
}
</style>
<script>
    
</script>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 
<div class="container-fluid px-4 mt-5" style="height:100hw">
    <div class="row d-flex text-center" style="height: 50vh">
        <h5>Ubicaciones para Toma de Inventario</h5>
        <div class="col-6">
            <table class="display cell-border compact " id="ubicacion" style="width:100%">
                <tfoot>
                    <tr>
                        <th></th>
                        <th>
                            <select class="form-select form-select-sm" aria-label="Default select example" id="suc_id" name="suc_id">
                                <option selected>Sucursal</option>
                            </select>
                        </th>
                        <th><input type="text" name="nro" class="form-control form-control-sm" placeholder="Nro"></th>
                        <th><input type="text"  name="nombre" class="form-control form-control-sm" autocomplete= "off" placeholder="Descrip"></th>
                        <th><button class="btn btn-sm btn-primary" id="guardar">Guardar</button></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@section('mis_scripts')
<script>
    $(document).ready(function(){
        var suc = {!! App\Unidad::where([['id','<>','1'],['id','<>', '8']])->get() !!};
        $.each(suc, function(i, item) {
            $('#suc_id').append($('<option>', { 
                value: item.id,
                text : item.nombre
            }));
        });
        var table = $('#ubicacion').DataTable({
            searching: true,
            paging:false,
            info:false,
            ordering: false,              
            ajax: 
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{route('tominvconfig.getubic')}}",
                type: "post",
                dataType: 'json',
                /*success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }*/
            },
            serverSide: true,
            processing: true,
            columns: [ 
                {data: 'id', title: 'id'},
                {data: 'suc_id', title: 'Sucursal'},
                {data: 'nro', title: 'nro'},
                {data: 'nombre', title: 'nombre'},                
                {data: 'id', title: 'OP'},
            ],
            /*columnDefs: [
                {
                    "targets": [4],
                    "visible": false,
                    "searchable": true
                }
            ],*/
            scrollY: "70vh",
            scrollX:true,
            scrollCollapse: true,
        });
        $("#guardar").on("click", function(event){
            //var nro = $("#nro").val();
            let nro = $(table.column(2).footer()).find('input').val();
            let nombre = $(table.column(3).footer()).find('input').val();
            let suc_id = $(table.column(1).footer()).find('select').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('tominvconfig.store')}}",
                type: 'POST',
                data: {nro, nombre, suc_id},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    table.ajax.reload();
                    $(table.column(2).footer()).find('input').val("");
                    $(table.column(3).footer()).find('input').val("");
                    $(table.column(1).footer()).find('select').val(""); 
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.errors);
                }
            }); 
                  
        });

        $(".page-wrapper").removeClass("toggled");         
    });
</script>
@endsection
