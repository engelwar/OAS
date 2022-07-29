@extends('layouts.app')
@section('static', 'statick-side')
@section('content')
@include('layouts.sidebar', ['hide'=>'1'])

  <div class="container w-75 p-5">
    <div class="row p-4 border rounded">
      <div class="col-lg-3  col-md-6 col-sm-6 col-xs-6 py-2 px-4 border-dark" data-toggle="tooltip" data-placement="top" title="Planificaciones">
        <a href="{{route('licencia.listado')}}" style="text-decoration: none;">
          <div class="card imc h-100 border text-center" style="background-color: #fff;">
            <div class="container d-flex justify-content-center px-0">
              <img class="card-img-top" src="{{ asset('imagenes/forms/1.jpg') }}" alt="img">
            </div>
            <div class="card-body px-2 py-2">
              <p class="mb-0 " style="overflow: hidden;">Reporte de Licencias</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3  col-md-6 col-sm-6 col-xs-6 py-2 px-4 border-dark" data-toggle="tooltip" data-placement="top" title="Planificaciones">
        <a href="{{route('vacacion.listado')}}" style="text-decoration: none;">
          <div class="card imc h-100 border text-center" style="background-color: #fff;">
            <div class="container d-flex justify-content-center px-0">
              <img class="card-img-top" src="{{ asset('imagenes/forms/2.jpg') }}" alt="img">
            </div>
            <div class="card-body px-2 py-2">
              <p class="mb-0 " style="overflow: hidden;">Reporte de Vacaciones</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

@endsection
@section('mis_scripts')
<script>
  $(document).ready(function() {
    $(".usuarios_param").click(function() {
      $(".usuarios_param").removeClass("active");
      $(this).toggleClass("active");
      var user = $(this).attr("id");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });
  });
  $('.almxu').change(function() {
    $()
    var user = $(".usuarios_param.active").attr("id");
    var alm = $(this).val();
    var state = $(this).is(':checked');
    if (user != undefined) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    }
  });
</script>
@endsection