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
        <div class="col-12 text-center">
                @if(isset($cont))
                    <h5 class="text-uppercase">{{$cont->toma->sucs->nombre}}</h5>
                    <h5>CONTEO NRO. {{$cont->conteo_id}}</h5>
                @endif
            <div class="row">
                <div class="col-3">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="basic-addon1">Faltante</span>
                        <input type="number" class="form-control form-control-sm" id= "f-desde" placeholder= "DESDE" value = 0>
                        <input type="number" class="form-control form-control-sm" id= "f-hasta" placeholder= "HASTA" value = 0>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="basic-addon1">Sobrante</span>
                        <input type="number" class="form-control form-control-sm" id= "s-desde" placeholder= "DESDE" value = 0>
                        <input type="number" class="form-control form-control-sm" id= "s-hasta" placeholder= "HASTA" value = 0>
                    </div>
                </div>
            </div>
            <table class="display cell-border compact" id="agregados" style="width:100%; font-size:0.8rem"></table>
            <div class="row mt-2">
                <div class="col d-flex justify-content-end">
                    <div class="btn-group" id="paginas">
                        <button class="btn btn-sm btn-success" id="actualizar"><i class="fas fa-sync-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
@section('mis_scripts')
<script>
    $(document).ready(function() 
    {   
        let notifier = new awn.default();

        //var conts = toma.conts;

        $(".pagin").on('click' , function(){
             filtrarPor($(this).val(), 7);
        });  

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
        $.each(users, function(i, item) {
            $('#user_id').append($('<option>', { 
                value: item.id,
                text : item.nombre +' '+ item.paterno
            }));
        });
        pdfMake.vfs = window.pdfFuentes.pdfMake.vfs;
        var cont = {!! json_encode($cont) !!};
        function crearTabla(cont){
            var titles = {!! json_encode($titles) !!};
            var modulos = {!! json_encode($modulos) !!};
            var table = $('#agregados').DataTable({
                searching: true,
                paging:false,
                info:false,
                ordering: true,              
                ajax: 
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{route('tominvprodubi.prods')}}",
                    type: "post",
                    data: function(d){
                        //let data_row = table_sucs.row('.selected').data();
                        //d.suc_id = data_row.suc_id;
                        d.fdesde = $('#f-desde').val();
                        d.fhasta = $('#f-hasta').val();
                        d.sdesde = $('#s-desde').val();
                        d.shasta = $('#s-hasta').val();
                        d.modulos = modulos;
                        d.cont_id = cont.id
                    },
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
                columns: titles,
                scrollY: "60vh",
                scrollX:true,
                scrollCollapse: true,
                drawCallback: function( settings ) {
                    //console.log(this.api().data());     
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: 'Copiar'                  
                    },                    
                    {
                        extend:'excel',
                        titleAttr: 'Export Excel',
                        title:null,
                        filename: 'Toma de Inventario',
                    },
                    {
                        extend:'pdf',
                        text: 'PDF',
                    }
                ],  
            });
            return table;
        }
        crearTabla(cont);
        $('#actualizar').click(function(){
            $('#agregados').DataTable().ajax.reload();
        });
        var path = "{{ route('tomainventario.prod') }}";
        $("#search_box").keyup(function(event)
        {
            load_data(this.value, event.keyCode);
            //var search = $(this).val();            
        });
        function get_text(event){
            var string = event.textContent;
            //fetch api
            fetch("process_data.php", {
                method:"POST",

                body: JSON.stringify({
                    search_query : string
                }),

                headers : {
                    "Content-type" : "application/json; charset=UTF-8"
                }
            }).then(function(response){
                return response.json();
            }).then(function(responseData){
                document.getElementsByName('search_box')[0].value = string;
                document.getElementById('search_result').innerHTML = '';
            });
        }

        //filtrarPor($('.ubicacion:checked').val(), 6);
        //filtrarPor($('.pagin:checked').val(), 7);
        function filtrarPor(value, col){
            regExSearch = '\\b' +value+ '\\b';
            $().column(col).search(regExSearch, true, false).draw();
        }

        $('#sucursales tbody').on( 'click', 'tr', function () {
            table_sucs.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            let data_row = table_sucs.row(this).data();
            data_sucursales_table = data_row.suc_id
            $('#agregados').DataTable().ajax.reload();
        } );
        //END sucursales
        $(".page-wrapper").removeClass("toggled"); 
    });
</script>
@endsection
