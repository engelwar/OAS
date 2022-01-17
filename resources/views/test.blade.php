@extends('layouts.app')

@section('content')
    <table id="testtable" class="cell-border compact hover" style="width: 100%">
        <thead>
            <tr>
                <th colspan = "2">GRUPO 1</th><th>GRUPO 2</th>
            </tr>
            <tr>
                <th class="text-danger"></th><th></th><th>Nick <button>Holi</button></th>
            </tr>
        </thead>
    </table>
@endsection
push('scripts')
@section('mis_scripts')
    <script>
    /*var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        //Si la petición es exitosa
        if (xhr.status >= 200 && xhr.status < 300) {
            //Mostramos un mensaje de exito y el contenido de la respuesta
            console.log(xhr.response);
        } else {
            //Si la conexión falla
            console.log('Error en la petición!');
        }
    };
    xhr.open('POST', "{{route('ventamarcauser.testeo')}}");
    var header = document.querySelector('[name="csrf-token"]').content;
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.setRequestHeader("X-CSRF-TOKEN", header);
    var data = JSON.stringify({"email": "hey@mail.com", "password": "101010"});
    xhr.send(data);*/
    /*$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{route('ventamarcauser.testeo')}}",
        type: "post",
        dataType: 'json',
        data: {valores:[{valor:"valor1"}, {valor:"valor2"}]},
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });*/

    $(document).ready(function() 
    {   
        var table = $("#testtable").DataTable({
            "processing": true,
            "serverSide": true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: 'Copiar',                        
                }],
            ajax: 
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{route('ventamarcauser.testeo')}}",
                type: "post",
                dataType: 'json',
                /*success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }*/
            },
            columns:[
                {data:'id', title: "id", name:'id'},
                {data:'name', title: "name", name:'name'},
                {data:'nick', name:'nick'},
            ]
        });
        //table.column(1).visible(false);        
        //table.column(0).visible(false);
    });
    </script>
@endsection
endpush