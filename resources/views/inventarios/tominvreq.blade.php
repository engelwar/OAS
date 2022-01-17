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
.completar:focus{
    background-color: #ff0000;
}
</style>
<script>
    
</script>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 
<div class="container-fluid px-4 mt-5" style="height:100hw">
    <div class="row d-flex justify-content-center" style="height: 50vh">
        <div class="col-8 text-center">
            <h5>Toma de Inventario</h5>
            <table class="display cell-border compact" id="agregados" style="width:100%; font-size:0.8rem">
                <tfoot>
                    <tr>
                        <td></td>
                        <td>
                            <select class="form-select form-select-sm" aria-label="Default select example" id="suc_id" name="suc_id" required>
                                <option selected>Sucursal</option>
                            </select>
                        </td>
                        <td>
                            <input type="text"  name="ubi" class="form-control form-control-sm" autocomplete= "off" placeholder="Ubicacion">
                        </td>                
                        <td>
                            <select class="form-select form-select-sm" aria-label="Default select example" id="user_id" name="user_id" required>
                                <option selected>Responsable</option>
                            </select>
                        </td>  
                        <td>
                            <input type="date"  name="fini" class="form-control form-control-sm" autocomplete= "off" value = "{{date('Y-m-d')}}">
                        </td>  
                        <td><button class="btn btn-sm btn-primary" id="guardar_tom">Guardar</button></td>
                    </tr>     
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@section('mis_scripts')
<script>
    $(document).ready(function() 
    {   
        /*let notifier = new awn.default();
        let options = {
            replacements: {
            modal: {
                'Class name': 'DOM Class'
            }
            }
        };
        notifier.modal(
            '<b>Custom modal window message</b><br>Class name: `awn-popup-modal-tiny`',
            'modal-tiny',
            options
        )*/
        var suc = {!! App\Unidad::where([['id','<>','1'],['id','<>', '8']])->get() !!};
        $.each(suc, function(i, item) {
            $('#suc_id').append($('<option>', { 
                value: item.id,
                text : item.nombre
            }));
        });
        var users = {!! App\Perfil::where([
            ['unidad_id','<>','1'],
            ['unidad_id','<>', '8'],
            ['id','<>', '2'],
            ['id','<>', '10'],
            ['id','<>', '52'],
            ['id','<>', '55'],
            ['id','<>', '56'],
            ['id','<>', '57']
        ])->get() !!};
            console.log(users);
        $.each(users, function(i, item) {
            $('#user_id').append($('<option>', { 
                value: item.id,
                text : item.nombre +' '+ item.paterno
            }));
        });
        function crearTabla(){
            var table = $('#agregados').DataTable({
                searching: false,
                paging:false,
                info:false,
                ordering: false,              
                ajax: 
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{route('tominvconfig.gettom')}}",
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
                    {data: 'id', title: 'ID'},   
                    {data: 'sucs.nombre', title: 'Sucursal'},
                    {data: 'ubi', title: 'Ubicacion',
                        render: function(data, type, row, meta){
                            return data;
                        }
                    },         
                    {data: 'funcionarios.nombre', title: 'Responsable'},  
                    {data: 'fini', title: 'Fecha Inicio'},
                    {data: 'id', title: 'OP', 
                        "render": function ( data, type, row, meta ) {
                            var btn = '<div class="btn-group">';
                            btn += '<a class="btn btn-sm btn-primary TomInvProd" href="{{route("tominvreq.index")}}/'+data+'/edit"><i class="fas fa-sign-in-alt"></i></a>';
                            btn += "</div>";
                            return btn;
                        }
                    },           
                ],
                scrollY: "70vh",
                scrollX:true,
                scrollCollapse: true,
                drawCallback: function( settings ) {
                    $(".TomInvProd").on("click", function(event){
                        console.log($(this).val());
                    });
                }                
            });
            return table;
        }
        var path = "{{ route('tomainventario.prod') }}";

        var table = crearTabla();

        function filtrarPor(value, col){
            regExSearch = '\\b' +value+ '\\b';
            table.column(col).search(regExSearch, true, false).draw();
        }
        //UBICACIONES
        var suc = {!! App\Unidad::where([['id','<>','1'],['id','<>', '8']])->get() !!};
        
        //CONTEOS
        $("#guardar_tom").on("click", function(event){
            //var nro = $("#nro").val();
            let suc_id = $(table.column(1).footer()).find('select').val();
            let ubi = $(table.column(2).footer()).find('input').val();
            let user_id = $(table.column(3).footer()).find('select').val();
            let fini = $(table.column(4).footer()).find('input').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('tominvconfig.storetom')}}",
                type: 'POST',
                data: {suc_id, ubi, user_id, fini},
                dataType: 'json',
                success: function (data) {
                    table.ajax.reload();
                    //$(table.column(4).footer()).find('input').val('');
                    //$(table.column(1).footer()).find('select').val('');
                    //$(table.column(3).footer()).find('select').val('');
                    //$(table.column(2).footer()).find('select').val('');
                    //$(table.column(5).footer()).find('select').val('');
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.errors);
                }
            });   

        });
        //END CONTEO
        $(".page-wrapper").removeClass("toggled"); 
    });
</script>
@endsection
