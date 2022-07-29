@extends('layouts.app')
@section('estilo')
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0'])
<div class="wrapper">
  <div class="d-flex justify-content-center p-4 w-100">
    <div class="border rounded w-100 bg-light pt-4">

      <div class="row p-2">
        <div class="col-12">
          <h3>LISTADO DE VACACIONES</h3>
        </div>
      </div>
      <div class="ps-2 pe-2">
        <table id="example" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>C.I.</th>
              <th>F. Inicio Solic.</th>
              <th>F. Fin Solic.</th>
              <th>Dias</th>
              <th>Horas</th>
              <th>Motivo</th>
              <th>Respaldo</th>
              <th>Estado</th>
              <th>Detalle</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($forms as $dato)
            <tr>
              <td>{{ $dato->user->perfiles->nombre }}</td>
              <td>{{ $dato->user->perfiles->paterno }} {{ $dato->user->perfiles->materno }}</td>
              <td>{{ $dato->user->perfiles->ci }}</td>
              <td>{{ $dato->fecha_ini }}</td>
              <td>{{ $dato->fecha_fin }}</td>
              <td>{{ $dato->dias }}</td>
              <td>{{ $dato->horas }}</td>
              <td>{{ $dato->motivo }}</td>
              <td>{{ $dato->respaldo }}</td>
              <td>{{ $dato->estado }}</td>
              <td>{{ $dato->detalle_estado }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('mis_scripts')
<script>
  $(document).ready(function() {
    $('#example').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'excel'
      ],
      "scrollX": true
    });

    $(".page-wrapper").removeClass("toggled");
  });
</script>
@endsection