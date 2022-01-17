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
<div class="container-fluid px-4 mt-5" style="height:100hw">
    <div class="row d-flex justify-content-center" style="height: 50vh">
        <div class="col-10"> 
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
                        <input id="um" type="text" class="form-control form-control-sm" name="um" readonly placeholder="U.M.">
                    </div>
                </div>               
            </div>
        </div>
    </div> 
    <!--div class="controles-form-esq-der">
        <button type="button" id="ubic_modal" class="btn btn-sm btn-primary">
            <i class="fas fa-thumbtack"></i>
        </button>
    </div--> 
    
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
        var path = "{{ route('tomainventario.prod') }}";
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
                                html += '<div class="autocompletar-result completar" id="'+response[count].prod+'"><span class="fw-bold"s>'+response[count].prod+'</span> '+response[count].descrip+'</div>';
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
        $("#search_box").keyup(function(event)
        {
            load_data(this.value, event.keyCode);
            //var search = $(this).val();            
        });
    });
</script>
@endsection
