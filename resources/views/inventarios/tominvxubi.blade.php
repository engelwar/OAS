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
        <div class="col-6"> 
            <h6>Tomas de Inventario</h6>
            <table class="display cell-border compact" id="tomas" style="width:100%; font-size:0.7rem">
            </table>
        </div>
        <div class="col-6">
            <h6>CONTEOS</h6>
            <div>
                @if(isset($tom))
                    @foreach($tom->conts as $c)
                        <input type="radio" value="{{$c->id}}" class="btn-check ubicacion" 
                        name="options-outlined" id="ubi_id_{{$c->id}}" 
                        autocomplete="off" @if($c->id==$c->first()->id) checked @endif>
                        <label class="btn btn-outline-primary" for="ubi_id_{{$c->conteo_id}}">{{$c->conteo_id}}</label>
                    @endforeach
                @endif
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
        //sucursales
        var table_sucs = $('#tomas').DataTable({
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
                {data: 'sucs.nombre', title: 'Sucursal'},
                {data: 'ubi', title: 'Ubicacion'},   
                {data: 'funcionarios.paterno', title: 'Responsable'}, 
                {data: 'fini', title: 'Fecha Inicio'},         
            ],
            scrollY: "70vh",
            scrollX:true,
            scrollCollapse: true,
            drawCallback: function( settings ) {
                $(".TomInvProd").on("click", function(event){
                    console.log($(this).val());
                });
                if ( ! $.fn.DataTable.isDataTable( '#agregados' ) ) {
                    this.$('tbody tr:first').addClass('selected');
                    crearTabla();                    
                }
            },        
        });
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
        function crearTabla(){
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
                    url:"{{route('tominvconfig.getcont')}}",
                    type: "post",
                    data: function(d){
                        let data_row = table_sucs.row('.selected').data();
                        d.tom_id = data_row.id;
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
                columns: [
                    {data: 'conteo_id', title: 'Nro Conteo'},      
                    {data: 'id', title: 'OP',
                        render: function(data, type, row, meta){
                            return '<a href="{{route("tominvprodubi.index")}}/'+row.id+'/edit" class="btn btn-sm btn-primary"><i class="fas fa-sign-in-alt"></i></a>';
                        },
                    },      
                ],
                scrollY: "70vh",
                scrollX:true,
                scrollCollapse: true,
                drawCallback: function( settings ) {
                    //console.log(this.api().data());     
                },
                createdRow: function( row, data, dataIndex ) {
                    //console.log(row.getElementsByTagName('td')[7]);
                    if (data.Conteo1 == 'Sin Conteo') {
                        let td = $(this).DataTable().cell(dataIndex,4).node();
                        $(td).addClass('text-danger');
                    }
                    if (data.Conteo2 == 'Sin Conteo') {
                        let td = $(this).DataTable().cell(dataIndex,5).node();
                        $(td).addClass('text-danger');
                    }
                    if (data.Conteo3 == 'Sin Conteo') {
                        let td = $(this).DataTable().cell(dataIndex,7).node();
                        $(td).addClass('text-danger');
                    }
                    if (data.diferencia == 0) {
                        let td = $(this).DataTable().cell(dataIndex,6).node();
                        $(td).addClass('text-success');
                    }
                    else{
                        let td = $(this).DataTable().cell(dataIndex,6).node();
                        $(td).addClass('text-danger');
                    }
                    if(data.faltante != 0){
                        let td = $(this).DataTable().cell(dataIndex,14).node();
                        $(td).addClass('text-danger');
                    }
                    
                    if(data.sobrante != 0){
                        let td = $(this).DataTable().cell(dataIndex,14).node();
                        $(td).addClass('text-success');
                    }
                }  
            });
            return table;
        }
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

        $('#tomas tbody').on( 'click', 'tr', function () {
            table_sucs.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#agregados').DataTable().ajax.reload();
        } );
        //END sucursales
        $(".page-wrapper").removeClass("toggled"); 
    });
</script>
@endsection
