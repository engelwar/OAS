@extends('layouts.app')

@section('mi_estilo')
 <style>
     @media (min-width: 600px) {
  .container_pad {
    padding:60px;
    padding-top: 0px;
  }
}
 </style>
@endsection

@section('content')
<div class="container_pad">
    <form method="POST" action="">
        @csrf
        @method('PATCH')
        <div class="row col d-flex justify-content-center mt-5">
            <div class="table-responsive">
                <div>
            </div>
        </div>
        <div class="row d-flex mt-5">
            <div class="col-4">
                <table class="cell-border compact" id="tabla" style="width:100%">
                    <!--thead class="text-center">
                        <th class="align-middle">Nombre</th>
                        <th class="align-middle">Descripcion</th>
                        <th class="align-middle">Icon</th>
                        <th>OP</th>
                    </thead-->
                    <tfoot>
                        <tr>
                            <td><input id="id" type="text" class="form-control form-control-sm" name="id"></td>
                            <td><input id="name" type="text" class="XD form-control form-control-sm" name="name"></td>
                            <td><input id="desc" type="text" class="form-control form-control-sm" name="desc"></td>
                            <td><input id="icon" type="text" class="form-control form-control-sm" name="icon"></td>
                            <td><button class="añadir btn btn-primary btn-sm" type="button"><i class="fas fa-save"></i></button></td>
                        </tr>
                    </tfoot>
                </table>                
            </div>
        </div>
    </form>
</div>

@endsection
@section('mis_scripts')
<script>

    $(document).ready(function(){

        var table = $("#tabla").DataTable({
            info:false, 
            paging:false,
            searching:false,
            ordering:false,
            ajax: 
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{route('sis.inv.config.list')}}",
                type: "post",
                dataType: 'json',
            },
            columns: [
                {name:'id', data:'id', title:'ID'},
                {name:'name', data:'name', title:'name'},
                {name:'desc', data:'desc', title:'desc'},
                {name:'icon', data:'icon', title:'icon'},
                {
                    name:'op', 
                    data:'id', 
                    title:'OP',
                    render: function ( data, type, row ) {
                        return '<button class="quitar btn btn-danger btn-sm" type="button" id="'+data+'""><i class="fas fa-times"></i></button>';
                    }
                }
            ],
            serverSide: true,
            processing: true,     
            scrollY: "70vh",
            scrollX:true,
            scrollCollapse: true,
        });
        $('table tbody').on( 'click', '.quitar', function () 
        {
            let id = $(this).attr("id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('sis.inv.config.destroy')}}",
                type: 'POST',
                data: {id},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });
            table.ajax.reload( null, false );
        });   
        $('.añadir').click(function(){
            var name = $('#name',table.table().footer()).val();
            var desc = $('#desc',table.table().footer()).val();
            var icon = $('#icon',table.table().footer()).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('sis.inv.config.store')}}",
                type: 'POST',
                data: {name, desc, icon},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });
            table.ajax.reload( null, false );
        });
    }); 
</script>

@endsection