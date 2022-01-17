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
.btn-outline-primary.odoo_hov:hover {
    background-color: #5c3266 !important;
    color: #ffffff !important;
}
.btn-check:checked + .btn-outline-primary.odoo_hov, .btn-check:active + .btn-outline-primary.odoo_hov, 
.btn-outline-primary.odoo_hov:active, .btn-outline-primary.odoo_hov.active, 
.btn-outline-primary.odoo_hov.dropdown-toggle.show
{
    background-color: #5c3266 !important;
    color: #ffffff !important;
}

body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
</style>
<script>
    
</script>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 
<div class="container-fluid px-4" style="height:100hw">
    <div class="row d-flex justify-content-center" style="height: 50vh">
        <div class="col-4 mt-5"> 
            <div class="row mb-3 text-center d-flex justify-content-center">
                <div class="col-auto">
                    <h6>Toma de Inventario Nro {{$tom->id}}</h6>
                    <h6>Sucursal {{$tom->Sucs->nombre}}, {{$tom->ubi}}</h6> 
                </div>  
            </div>
            <div class="row pb-4 text-center d-flex justify-content-center border-bottom">
                <div class="col-auto">
                    <div class="input-group input-group-sm ms-2">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Conteo</span>
                        @foreach($tom->conts as $c)
                            <input type="radio" value="{{$c->id}}" class="btn-check conteo" 
                            name="options-outlined" id="cont_id_{{$c->conteo_id}}" 
                            @if($c->conteo_id==1) checked @endif>
                            <label class="btn btn-outline-primary btn-sm" for="cont_id_{{$c->conteo_id}}">{{$c->conteo_id}}</label>
                        @endforeach
                    </div>
                </div>
                <div class="col-auto">
                    <form action="{{route('tomainventario.pdf')}}" method="POST" target="_Blank">
                        @csrf
                        <input type="hidden" name="tom_id" value="{{$tom->id}}">
                        <button class="btn btn-sm btn-outline-danger" type="submit" id="pdf">PDF</button>
                    </form>
                </div>
                <div class="col-auto"> 
                    <form action="{{route('tomainventario.excel')}}" method="POST">
                        @csrf
                        <input type="hidden" name="tom_id" value="{{$tom->id}}">
                        <input type="hidden" id="cont_id" name="cont_id" value="{{$tom->conts->first()->id}}">
                        <button class="btn btn-sm btn-outline-success" type="submit" id="excel">EXCEL</button>
                    </form>
                </div>
            </div>
            <div class="row mt-4 mb-2">
                <div class="col">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Modulo</span>
                        <input style="max-width:30%" class="form-control form-control-sm" list="prod_ubi_nro_options" id="prod_ubi_nro" placeholder="Ubicacion">
                        <datalist id="prod_ubi_nro_options">
                        </datalist>
                        <input class="form-control form-control-sm" name="ubicacion_descrip" id="ubi_descrip" placeholder="Descripcion de Ubicacion" autocomplete="off">
                        <button class="btn btn-sm btn-outline-success" type="button" id="ubi_descrip_button">+</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <h5 class="align-middle">Producto
                    <span>
                        <div class="btn-group" id="tip_prod">
                            <input type="radio" value="prod_id_dual" class="btn-check fuente_prod" 
                            name="prods-outlined" id="prod_id_dual" checked >
                            <label class="btn btn-sm btn-outline-primary" for="prod_id_dual">Dual</label>
                            <input type="radio" value="prod_id_odoo" class="btn-check fuente_prod" 
                            name="prods-outlined" id="prod_id_odoo">
                            <label class="btn btn-sm btn-outline-primary odoo_hov disabled" style="border-color: #732088;color:#732088" for="prod_id_odoo">Odoo</label>
                            <input type="radio" value="prod_id_new" class="btn-check fuente_prod" 
                            name="prods-outlined" id="prod_id_new">
                            <label class="btn btn-sm btn-outline-danger" for="prod_id_new">Nuevo</label>
                        </div>
                    </span>
                </h5>
                
            </div>
            <div class="row mb-1">
                <div class="col-sm-12">
                    <div class="input-group">
                        <input type="text" name="search_box" class="form-control form-control-sm" placeholder="Buscar"
                        placeholder="Producto" id="search_box" autocomplete="off"/>
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <div id="search_result"></div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-12">
                    <div class="input-group">
                        <input id="prod" type="text" class="form-control form-control-sm" name="prod" placeholder="Codigo" readonly>
                        <input id="marca" type="text" class="form-control form-control-sm" name="marca" placeholder="Marca" readonly>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-12">
                    <input id="descrip" type="text" class="form-control form-control-sm" name="descrip" placeholder="Descripcion" readonly>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-12">
                    <input id="barcod" type="text" class="form-control form-control-sm" placeholder="Cod. Barras" name="barcod">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="input-group">
                        <input id="cantidad" type="number" class="form-control form-control-sm" name="cantidad" placeholder="Cantidad" autocomplete="off">
                        <input id="um" type="text" class="form-control form-control-sm" name="um" readonly placeholder="U.M.">
                    </div>
                </div>               
            </div>
            <div class="row justify-content-center mb-3">
                    <button class="btn btn-sm btn-primary w-75" id="guardar">Ingresar <i class="fas fa-save"></i></button>
            </div>
        </div>
        <div class="col-8">
            <div>
                <table class="display cell-border compact mt-2" id="agregados" style="width:100%; font-size:0.75rem"></table>
            </div>
            <div id="controles" style="z-index:1000;position:fixed;bottom:5px;right:5px;">
                <div class="input-group">
                    <div class="btn-group" id="paginas" style="width:63vw;overflow:auto">
                    </div>
                   <button type="button" class="btn btn-sm btn-success" id="mas_pag">+</button>                   
                </div>
            </div>
        </div>
    </div> 
    <div class="controles-form-esq">
        <button type="button" id="ubic_modal" class="btn btn-sm btn-primary">
            <i class="fas fa-thumbtack"></i>
        </button>
    </div> 
    
    <!--h2>Animated Modal with Header and Footer</h2>

    <button id="myBtn">Open Modal</button>
    
    <div id="myModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">&times;</span>
          <h2>Modal Header</h2>
        </div>
        <div class="modal-body">
          <p>Some text in the Modal Body</p>
          <p>Some other text...</p>
        </div>
        <div class="modal-footer">
          <h3>Modal Footer</h3>
        </div>
      </div>
    
    </div-->
</div>
@endsection
@section('mis_scripts')
<script>
    $(document).ready(function() 
    {   
        /*// Get the modal
        var modal = document.getElementById("myModal");
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }*/

        let notifier = new awn.default();
        const toma = {!! json_encode($tom) !!};
        var conts = toma.conts;
        $('#ubic_modal').click(function(){
            //myModal.show();
        });

        $('#ubi_descrip_button').on('click', function(){       
            let nro = $('#prod_ubi_nro').val(); 
            let descrip = $('#ubi_descrip').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('tomainventario.storeprodubi')}}",
                type: 'POST',
                data: {nro, descrip, tom_id},
                dataType: 'json',
                success: function (data) {
                    get_ubi_prod();
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.errors);
                }
            }); 
        });

        $(".fuente_prod").on('change', function()
        {      
            let tip = $(this).val()
            if(tip== 'prod_id_odoo')
            {
                $('#search_box').attr('readonly', false);
                $('#prod').attr('readonly', true);
                $('#marca').attr('readonly', true);
                $('#descrip').attr('readonly', true);
                $('#um').attr('readonly', true);
                $("#search_box").focus();
            }
            else if (tip== 'prod_id_dual'){
                $('#search_box').attr('readonly', false);
                $('#prod').attr('readonly', true);
                $('#marca').attr('readonly', true);
                $('#descrip').attr('readonly', true);
                $('#um').attr('readonly', true);
                $("#search_box").focus();
            }
            else if (tip== 'prod_id_new'){
                $('#search_box').attr('readonly', true);
                $('#prod').attr('readonly', true);
                $('#marca').attr('readonly', false);
                $('#descrip').attr('readonly', false);
                $('#um').attr('readonly', true);
                $("#marca").focus();
            }
            /*let id = $(this).val();
            let prod = $(this).find('option:selected').text();
            let marca = $(this).find('option:selected').data('marca');
            let descrip = $(this).find('option:selected').data('descrip');
            $('#prod').val(id);
            $('#marca').val(marca);
            $('#descrip').val(descrip);+*/
            
        });

        function paginasCreate(pag){
            $("#paginas").empty();
            let add= '';
            if(pag.length > 0){
                for(let i=1; i<=Math.max(...pag); i++)
                {
                    add += '<button type="button" value="'+i+'" class="btn btn-sm btn-outline-primary pagin" name="options-pag" id="pag_'+i+'">'+i+'</button>';                   
                }   
                               
            }       
            else if(pag.length == 0){
                add += '<button type="button" value="1" class="btn btn-sm btn-outline-primary pagin" name="options-pag" id="pag_1">1</button>'
            }
            $("#paginas").append(add); 
            $("#pag_1").addClass('active');
            //add = '<button type="button" class="btn btn-sm btn-outline-primary" id="mas_pag">+</button>';
            filtrar_pag(); 
        }
        function mas_pags(){
            $("#mas_pag").on("click", function(){
                hoja = $("#paginas button:last").val();
                console.log(hoja);
                hoja = parseInt(hoja)+1;
                let add = '<button type="button" value="'+hoja+'" class="btn btn-sm btn-outline-primary pagin" name="options-pag" id="pag_'+hoja+'">'+hoja+'</button>';
                $("#paginas").append(add);
                $("#paginas").scrollLeft(500000);
                filtrar_pag();
            });
        }
        $(".conteo").on('click' , function(){
            //filtrarPor($(this).val(), 6);
            let conteo_f = $(this).val();
            $('#cont_id').val($(this).val());
            //paginasCreate();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('tomainventario.paginas')}}",
                type: 'POST',
                dataType: 'json',
                data: {conteo_f, tom_id},
                success: function (data) {
                    paginasCreate(data);
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.errors);
                }
            });
            table.ajax.reload();
        });    
        function filtrar_pag(){
            $(".pagin").on('click' , function(){
                $("#paginas .pagin.active").removeClass('active');
                $(this).addClass('active');
                //filtrarPor($(this).val(), 7);
                table.ajax.reload();
            }); 
        }
        filtrar_pag();

        function get_ubi_prod(){
            let toma = {!! json_encode($tom) !!};
            tom_id = toma.id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('tomainventario.getprodubi')}}",
                type: 'POST',
                data: {tom_id:tom_id},
                dataType: 'json',
                success: function (data) {
                    $('#prod_ubi_nro').next()
                    .find('option')
                    .remove()
                    .end();
                    $.each(data, function(i, item) {
                        $('#prod_ubi_nro').next().append($('<option>', { 
                            value: item.nro,
                            text : item.descrip
                        }));
                    }); 
                    $('#prod_ubi_nro').bind('input', function(){
                        for(let i=0; i<data.length; i++)
                        {
                            if($(this).val() == data[i].nro)
                            {
                                $('#ubi_descrip').val(data[i].descrip);
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.errors);
                }
            }); 
        }     
        get_ubi_prod();
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

        function crearTablaUbi(){
            var table_ubi = $('#ubicaciones').DataTable({
                searching: false,
                paging:false,
                info:false,
                ordering: false,              
                ajax: 
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{route('tomainventario.getprodubi')}}",
                    type: "post",
                    dataType: 'json',
                    data: {tom_id:tom_id, getTable:true},
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
                    {data: 'nro', name: 'nro'},
                    {data: 'descrip', name: 'descrip'},         
                ],
                scrollY: "70vh",
                scrollX:true,
                scrollCollapse: true,
                drawCallback: function( settings ) {  
                    $(".cabeza_tab").style.width = "100%";   
                } 
            });
            return table_ubi;
        }
        crearTablaUbi();
        function crearTabla(toma){
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
                    url:"{{route('tomainventario.ingresos')}}",
                    type: "post",
                    dataType: 'json',
                    data: function(d){
                        d.tom_id = toma.id;
                        let pag_f = $(".pagin.active").val();
                        let conteo_f = $(".conteo:checked").val();
                        d.conteo_f = conteo_f;
                        if(pag_f==undefined)
                        {
                            d.pag_f = 1;
                        }
                        else
                        {
                            d.pag_f = pag_f;
                        }
                        //console.log(d);
                    },
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
                    {data: "id",
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'prod', title: 'Producto'},
                    {data: 'marca', title: 'Marca'},
                    {data: 'descrip', title: 'Descripción'},
                    {data: 'um', title: 'UM', className:"text-center"}, 
                    {data: 'barcod', title: 'Cod.Barras'},
                    {data: 'cantidad', title: 'Cant', className: "text-end"},      
                    //{data: 'cont_id', title: 'cont_id'},    
                    {data: 'ubi.nro', title: 'Mod', className: "text-end"},     
                    //{data: 'hoja', title: 'hoja'},       
                ],
                scrollY: "85vh",
                scrollX:true,
                scrollCollapse: true,
                drawCallback: function( settings ) {
                    if($("#paginas").children('.pagin').length == 0){
                        var paginas = this.api().ajax.json().paginas;
                        paginasCreate(paginas); 
                        mas_pags();   
                    }
                    /*$("#agregados tbody tr td").on('click', function () {     
                        if($("#agregados tbody tr td input").length != 0 && $(this).children().length == 0)
                        {
                            table.ajax.reload();
                        } 
                        else if ($(this).children().length == 0){
                            var col = $(this).parent().children().index($(this));
                            var dataname = table.column(col).dataSrc();
                            var text = $(this).text();
                            $(this).text("");
                            //let input= '<div class="input-group edit-conten">';
                            let input= '<input class="form-control form-control-sm" type="text" value="'+text+'">';
                            //input+= '<div class="input-group-append">';
                            //input+= '<button class="btn btn-sm btn-outline-success edit-acept" type="button"><i class="fas fa-check"></i></button>';
                            //input+= '<button class="btn btn-sm btn-outline-danger" type="button"><i class="fas fa-times"></i></button></div></div>';
                            $(this).append(input);

                            //table.ajax.reload();
                        }
                        
                    });*/
                } 
            });
            
            return table;
        }
          var path = "{{ route('tomainventario.prod') }}";
        $("#search_box").keyup(function(event)
        {
            
                var code = event.keyCode || event.which;
                console.log(code);
                if (code == '9') {
                alert('Tab pressed');
            }
            load_data(this.value, event.keyCode);
            //var search = $(this).val();            
        });
        $("#search_box").keydown(function(event)
        {
            var code = event.keyCode || event.which;
            console.log(code);
            if (code == '9') {
                alert('Tab pressed');
            }
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
        function load_data(query, tecla){
            if(query.length > 1)
            {
                var form_data = new FormData();
                form_data.append('query', query);
                var ajax_request = new XMLHttpRequest();
                //ajax_request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                //ajax_request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-8');
                ajax_request.open('POST', path);
                var token = $('meta[name="csrf-token"]').attr('content');
                ajax_request.setRequestHeader('X-CSRF-TOKEN', token);
                ajax_request.send(form_data);

                ajax_request.onreadystatechange = function()
                {
                    if(ajax_request.readyState == 4 && ajax_request.status == 200)
                    {
                        var response = JSON.parse(ajax_request.responseText);

                        var html = '<div class="autocompletar-content">';
                        if(response.length > 0)
                        {
                            for(var count = 0; count < response.length; count++)
                            {
                                html += '<div class="autocompletar-result completar" id="'+response[count].prod+'"><span class="fw-bold"s>'+response[count].prod+'</span> '+response[count].descrip+' <span class="fw-bold"s>('+response[count].um+')</span></div>';
                            }
                        }
                        else
                        {
                            html += '<div class="autocompletar-result">No se encontro lo que busca</div>';
                        }
                        html += '</div>';
                        document.getElementById('search_result').innerHTML = html;
                        $(".completar").on("click", function(event){
                            let id = $(this).attr('id');
                            for(var i=0; i<response.length; i++) {
                                if(response[i]['prod']==id) {
                                    $("#prod").val(response[i]['prod']);
                                    $("#marca").val(response[i]['marca']);
                                    $("#descrip").val(response[i]['descrip']); 
                                    $("#barcod").val(response[i]['BarCod']); 
                                    $("#um").val(response[i]['um']); 
                                    document.getElementById('search_result').innerHTML = "";
                                }
                            }   
                            $("#cantidad").focus();  
                        });

                        if(tecla == 13){
                            $("#prod").val(response[0]['prod']);
                            $("#marca").val(response[0]['marca']);
                            $("#descrip").val(response[0]['descrip']); 
                            $("#barcod").val(response[0]['BarCod']); 
                            $("#um").val(response[0]['um']); 
                            document.getElementById('search_result').innerHTML = "";
                            //console.log($(".autocompletar-content .autocompletar-result")[0]);
                            $("#cantidad").focus(); 
                        }
                        if(tecla == 40){
                            $("#search_box").focusout();
                            $(".completar .button")[0].focus();
                            var count = 0;
                            
                        }
                        $('.completar .button').on('keydown', function(e) {
                            if (e.keyCode === 40) {
                                $(".completar .button")[count++].focus();
                            }
                            if (e.keyCode === 38) {
                                $(".completar .button")[count--].focus();
                            }
                        });
                    }
                }
            }
            else
            {
                document.getElementById('search_result').innerHTML = '';
            }
        }
        $("#guardar").on("click", function(event){
            if($('#prod_id_dual').is(':checked')) {
                var nuevo = 0;
                var prod = $("#prod").val();
            }
            else if($('#prod_id_odoo').is(':checked')) {
                var nuevo = 2;
                var prod = $("#prod").val();
            }
            else if($('#prod_id_new').is(':checked')) {
                var nuevo = 1;
                var prod = null;
            }            
            var marca = $("#marca").val();
            var descrip = $("#descrip").val();
            var barcod = $("#barcod").val();
            var cantidad = $("#cantidad").val();
            var user_id = $("#user_id").val();
            var um = $("#um").val();
            var nro = $("#numero").val();
            var cont = $('.conteo:checked').val();
            var hoja = $('.pagin.active').val();

            var prod_ubi_nro = $("#prod_ubi_nro").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('tomainventario.store')}}",
                type: 'POST',
                data: {prod, marca, descrip, barcod, cantidad, user_id, um, nuevo, nro, cont_id:cont, hoja:hoja, prod_ubi_nro, tom_id},
                dataType: 'json',
                success: function (data) {
                    if(data.error)
                    {
                        notifier.alert(data.error);
                    }
                    else{
                        table.ajax.reload();
                        console.log(data);
                        var $container = $('#agregados tbody');
                            $scrollTo = $('#agregados tbody tr:last');

                        $container.scrollTop(
                            $scrollTo.offset().top - $container.offset().top + $container.scrollTop()
                        );
                    }
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")"); 
                    var error = Object.values(err.errors)[0][0];                 
                    notifier.alert(error);
                }
            });  
            $("#prod").val("");
            $("#marca").val("");
            $("#descrip").val("");
            $("#barcod").val("");
            $("#cantidad").val("");
            $("#um").val("");    
            $("#search_box").val("");  
            $("#search_box").focus();
        });

        var table = crearTabla(toma);

        function filtrarPor(value, col){
            regExSearch = '\\b' +value+ '\\b';
            table.column(col).search(regExSearch, true, false).draw();
        }
        $(".page-wrapper").removeClass("toggled"); 

        $("#cantidad").on("keyup", function(event){
            if(event.keyCode == 13) {
                $("#guardar").click();
            }
        });
    });
</script>
@endsection
