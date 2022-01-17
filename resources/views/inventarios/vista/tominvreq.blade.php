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
.back-rojo{
    background-color: #ffe0e0;
}
.back-azul{
    background-color: #ddedfa;
}
.back-verde{
    background-color: #e1ffe3;
}
</style>
<script>
    
</script>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 
<div class="container-fluid px-4" style="height:100hw">
    <!--div class="row mb-3">
        <div class="col-sm-2">
            <label for="Numero" class="form-label form-label-sm">Numero</label>
            <input class="form-control form-control-sm" list="datalistOptions" id="numero" name="numero"placeholder="Numero">
            <datalist id="datalistOptions">
              <option value="1">
            </datalist>
        </div>
        <div class="col-sm-2">
            <label for="suc_id" class="form-label form-label-sm">Sucursal</label>
            <select class="form-select form-select-sm" aria-label="Default select example" id="suc_id" name="suc_id" required>
                <option selected>Sucursal</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label for="suc_id" class="form-label form-label-sm">Ubicacion</label>
            <select class="form-select form-select-sm" aria-label="Default select example" id="ubi_id" name="ubi_id" required>
                <option selected>Ubicacion</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label for="suc_id" class="form-label form-label-sm">Conteo</label>
            <select class="form-select form-select-sm" aria-label="Default select example" id="conteo_id" name="conteo_id" required>
                <option selected>Conteo</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">Conteo de Verificacion</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label for="suc_id" class="form-label form-label-sm">Responsable</label>
            <select class="form-select form-select-sm" aria-label="Default select example" id="user_id" name="user_id" required>
                <option selected>Responsable</option>
            </select>
        </div>       
    </div-->
    <div class="row d-flex justify-content-center mt-2 ">
        <div class="col-auto">
            <div class="row">
                <div class="col-auto d-flex offset-md-1">
                    <div class="input-group input-group-sm">
                        <select class="form-select form-select-sm" aria-label="Default select example" id="cont_filt" name="cont_filt" required>
                            <option selected value="cont_fis">Conteo Fisico</option>
                            <option value="cont1">Conteo 1</option>
                            <option value="cont2">Conteo 2</option>
                            <option value="cont3">Conteo 3</option>
                        </select>
                        <span class="input-group-text">Faltantes Del:</span>
                        <input type="number" class="form-control" id="fmin">
                        <span class="input-group-text">Al:</span>
                        <input type="number" class="form-control" id="fmax" name="fmax">
                        <span class="input-group-text">Sobrantes Del:</span>
                        <input type="number" class="form-control" id="smin">   
                        <span class="input-group-text">Al:</span>
                        <input type="number" class="form-control" id="smax" name="smax"> 
                        <button class="btn btn-sm btn-outline-primary" type="button" id="filtrar"><i class="fas fa-filter"></i></button>
                    </div>
                    <div class="input-group input-group-sm" style="width:50%">
                        <input type="text" class="form-control form-control-sm ms-2" id="buscar"> 
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
            <table class="display cell-border compact" id="agregados" style="width:100%; font-size:0.75rem">
                <thead>
                    <tr style="font-size:0.75rem;" class="text-center">
                        <th rowspan="2">Codigo</th>
                        <th rowspan="2">Descripcion</th>
                        <th rowspan="2">UM</th>
                        <th rowspan="2">Stock Actual</th>
                        <th rowspan="2">Costo Actual</th>
                        <th colspan="3">Conteo1</th>
                        <th colspan="3">Conteo2</th>
                        <th colspan="3">Conteo3</th>
                        <th colspan="3">Conteo Fisico</th>
                        <th rowspan= "2">Modulos</th>
                    </tr>
                    <tr style="font-size:0.65rem;">
                        <th>Conteo</th>
                        <th>Faltante</th>
                        <th>Sobrante</th>
                        <th>Conteo</th>
                        <th>Faltante</th>
                        <th>Sobrante</th>
                        <th>Conteo</th>
                        <th>Faltante</th>
                        <th>Sobrante</th>
                        <th>Conteo</th>
                        <th>Faltante</th>
                        <th>Sobrante</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th id="btn-filt-t" style="cursor:pointer">TOTAL</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="row mt-2">
                <div class="col d-flex justify-content-end">
                        <button class="btn btn-sm btn-success" id="actualizar"><i class="fas fa-sync-alt"></i></button>
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
        $("#filtrar").on('click', function(){
            $('#agregados').DataTable().ajax.reload();
        });
        function crearTabla(){
            var table = $('#agregados').DataTable({
                searching: true,
                paging:false,
                info:false,
                ordering: false,              
                ajax: 
                {
                    headers: {
                        'X-CSRF-TOKEN': {!!json_encode(csrf_token())!!}
                    },
                    url:"{{route('tominvreq.prods')}}",
                    type: "post",
                    data: function(d){
                        toma = {!! json_encode($toma) !!};
                        d.tom_id = toma.id;
                        d.fmin = $("#fmin").val();
                        d.fmax = $("#fmax").val();
                        d.smin = $("#smin").val();
                        d.smax = $("#smax").val();
                        d.cont_filt = $("#cont_filt").val();
                        console.log(d);
                    },
                    dataType: 'json',
                    /*success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }*/
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        // Note: You can use "textStatus" to describe the error.
                        // Custom
                        switch(jqXHR.status)
                        {
                            case 404:
                                //alert('Requested page not found. [404] XD');
                            break;
                            
                            case 500:
                                //alert('Internal Server Error [500] XD');
                            break;
                            
                            default:
                                //alert('Unexpected unknow error XD');
                            break;
                        }
                        
                        // Global
                        if (jqXHR.status != 0)
                        {
                            console.log('A system error has occurred (More information) XD.');
                            //$("#agregados").DataTable().ajax.reload();
                            // Or you can invoke modal bootstrap rather than a java alert.   
                        }
                    },
                },
                serverSide: true,
                processing: true,
                columns: [
                    {data: 'prod', title: 'Producto'},
                    //{data: 'marca', title: 'Marca'},
                    {data: 'descrip', title: 'Descripción'},
                    {data: 'um', title: 'UM'}, 
                    //{data: 'tipo', title: 'Tipo'},
                    {data: 'stock', title: 'Stock Actual', className: 'text-end'},
                    {data: 'costo', title: 'Costo Dual', className: 'text-end'},
                    {data: 'Conteo1', name: 'Conteo', className: 'conteo1 text-end'}, 
                    {data: 'faltante1', name: 'Faltante', className: 'conteo1 text-end'}, 
                    {data: 'sobrante1', name: 'Sobrante', className: 'conteo1 text-end'}, 
                    {data: 'Conteo2', name: 'Conteo', className: 'conteo2 text-end'},
                    {data: 'faltante2', name: 'Faltante', className: 'conteo2 text-end'}, 
                    {data: 'sobrante2', name: 'Sobrante', className: 'conteo2 text-end'}, 
                    {data: 'Conteo3', name: 'Conteo', className: 'conteo3 text-end'},  
                    {data: 'faltante3', name: 'Faltante', className: 'conteo3 text-end'}, 
                    {data: 'sobrante3', name: 'Sobrante', className: 'conteo3 text-end'},        
                    //{data: 'sucursal', title: 'Sucursal'},     
                    {data: 'contfis', name: 'Conteo', className: 'text-end'},
                    {data: 'faltante', name: 'Faltante', className: 'text-end'},
                    {data: 'sobrante', name: 'Sobrante', className: 'text-end'},  
                    {data: 'prod_ubi_nros', title: 'Modulos', className: 'text-end'},  
                     
                ],
                
                scrollY: "65vh",
                scrollX:true,
                scrollCollapse: true,
                drawCallback: function( settings ) {
                    //console.log(this.api().data());
                    $("#btn-faltante").prop('disabled', false);
                    $("#btn-sobrante").prop('disabled', false);
                    $("#btn-igual").prop('disabled', false); 
                    $(this.api().column(0).footer()).html("Cant: "+this.api().column(0).data().length);
                    for(var i=3; i<=16; i++){
                        if(i==4)
                        {
                            let num = this.api().column(i).data().sum(); 
                            $(this.api().column(i).footer()).html(num.toFixed(4)); 
                        }
                        else{
                            $(this.api().column(i).footer()).html(this.api().column(i).data().sum()); 
                        }
                    }
                },
                createdRow: function( row, data, dataIndex ) {
                    //console.log(row.getElementsByTagName('td')[7]);
                    if (data.faltante1 > 0) {
                        let td = $(this).DataTable().cell(dataIndex,5).node();
                        $(td).addClass('text-danger');
                    }
                    else if (data.sobrante1 > 0)
                    {
                        let td = $(this).DataTable().cell(dataIndex,5).node();
                        $(td).addClass('text-success');
                    }
                    if (data.faltante2 > 0) {
                        let td = $(this).DataTable().cell(dataIndex,8).node();
                        $(td).addClass('text-danger');
                    }
                    else if (data.sobrante2 > 0)
                    {
                        let td = $(this).DataTable().cell(dataIndex,8).node();
                        $(td).addClass('text-success');
                    }
                    if (data.faltante3 > 0) {
                        let td = $(this).DataTable().cell(dataIndex,11).node();
                        $(td).addClass('text-danger');
                    }
                    else if (data.sobrante3 > 0)
                    {
                        let td = $(this).DataTable().cell(dataIndex,11).node();
                        $(td).addClass('text-success');
                    }
                    if (data.faltante > 0) {
                        let td = $(this).DataTable().cell(dataIndex,14).node();
                        $(td).addClass('text-danger');
                    }
                    else if (data.sobrante > 0)
                    {
                        let td = $(this).DataTable().cell(dataIndex,14).node();
                        $(td).addClass('text-success');
                    }
                },
                dom: 'Brtip',
                buttons: [                   
                    {
                        extend:'excel',
                        titleAttr: 'Export Excel',
                        title:null,
                        filename: 'Toma de Inventario',
                        customize: function (xlsx) 
                        { 
                            console.log(xlsx);
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            var downrows = 3;
                            var clRow = $('row', sheet);
                            //update Row
                            clRow.each(function () {
                                var attr = $(this).attr('r');
                                var ind = parseInt(attr);
                                ind = ind + downrows;
                                $(this).attr("r",ind);
                            });
                    
                            // Update  row > c
                            $('row c ', sheet).each(function () {
                                var attr = $(this).attr('r');
                                var pre = attr.substring(0, 1);
                                var ind = parseInt(attr.substring(1, attr.length));
                                ind = ind + downrows;
                                $(this).attr("r", pre + ind);
                            });
                    
                            function Addrow(index,data) {
                                msg='<row r="'+index+'">'
                                for(i=0;i<data.length;i++){
                                    var key=data[i].k;
                                    var value=data[i].v;
                                    msg += '<c t="inlineStr" r="' + key + index + '" s="42">';
                                    msg += '<is>';
                                    msg +=  '<t>'+value+'</t>';
                                    msg+=  '</is>';
                                    msg+='</c>';
                                }
                                msg += '</row>';
                                return msg;
                            } 
                    
                            //insert
                            var r1 = Addrow(1, [{ k: 'A', v: 'Toma de Inventario' }, { k: 'B', v: '' }, { k: 'C', v: '' }]);
                            $('row c[r^="R"]', sheet).attr( 's', '0' );
                            sheet.childNodes[0].childNodes[1].innerHTML = r1+ sheet.childNodes[0].childNodes[1].innerHTML;
                        }
                    },
                    
                ],  
            });
            return table;
        }
        crearTabla();

        $("#btn-filt-t").click(function(){
            /*if($("#filt-t").=="TOTAL")
            {
                alert("Seleccione una sucursal");
                return;
            }*/
        });


        $("#buscar").on('keyup', function(){
            $('#agregados').DataTable().search(this.value).draw();
        });

        $('#actualizar').click(function(){
            $('#agregados').DataTable().clear().draw();
            //$('#agregados').DataTable().ajax.reload();
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
        //END sucursales
        $(".page-wrapper").removeClass("toggled"); 
    });
</script>
@endsection
