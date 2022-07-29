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
      <div class="pe-2 ps-2">
        <table id="example" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>C.I.</th>
              <th>Detalle</th>
              <th>F. Inicio Solic.</th>
              <th>F. Fin Solic.</th>
              <th>F. Retorno Solic.</th>
              <th>F. Inicio Autor.</th>
              <th>F. Fin Autor.</th>
              <th>F. Retorno Autor.</th>
              <th>Dias de Vacacion</th>
              <th>Dias Solic.</th>
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
              <td>{{ $dato->detalle_vacacion }}</td>
              <td>{{ $dato->fecha_ini }}</td>
              <td>{{ $dato->fecha_fin }}</td>
              <td>{{ $dato->fecha_ret }}</td>
              <td>{{ $dato->fecha_ini_aut }}</td>
              <td>{{ $dato->fecha_fin_aut }}</td>
              <td>{{ $dato->fecha_ret_aut }}</td>
              <td>{{ $dato->dias_v }}</td>
              <td>{{ $dato->dias }}</td>
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