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
    <div class="card w-100" style="margin-top: 40px">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <div class="row justify-content-center mt-4">
            <div class="col">
               <table id="example"  class="display" style="width: 100%">
                   <thead>
                    <tr>
                        <th>Acccion</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Unidad</th>
                        <th>codigo de barras</th>
                        <th>precio punto de ventas</th>
                    </tr>
                   </thead>
                   <tbody>
                    @foreach ($collection as $item)
                        
                    @endforeach
                    <tr>
                        <td></td>
                    </tr>
                   </tbody>
               </table>        
            </div>
        </div>
          <p class="card-text">With supporting text below as a natural lead-in to additional content. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eum neque qui. Delectus omnis perspiciatis, amet eligendi harum voluptate ratione odio architecto officia pariatur quia, ducimus labore libero quod minus.</p>
          <a href="#" class="btn btn-primary">Button</a>
        </div>
      </div>
      
      <div class="card w-100">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Button</a>
        </div>
      </div>
 
</div>
@endsection

@section('mis_scripts')
<script>
    $(document).ready(function () {
    $('#example').DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
    });
});
        $(".page-wrapper").removeClass("toggled"); 
  
    </script>
@endsection
