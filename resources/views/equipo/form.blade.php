<div class="box box-info padding-1">
  <div class="card-body">
      {{-- <div class="w-50 m-auto mb-4">
        <select class="form-select" name="id_empleado[]" required>
            <option selected>Seleccionar empleado</option>
            @foreach ($empleados as $em)
              <option value="{{$em->id}}">{{$em->nombre}} {{$em->paterno}}</option>
            @endforeach
        </select>
      </div> --}}
    <div class="table-responsive">
      <table class="table table-striped table-hover" id="table">
        <thead class="thead">
          <tr>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Modelo</th>
            <th>N/S</th>
            <th>Caracteristicas</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <input class="form-control" type="text" name="marca[]" placeholder="Marca">
            </td>
            <td>
              <input class="form-control" type="text" name="tipo[]" placeholder="Tipo">
            </td>
            <td>
              <input class="form-control" type="text" name="modelo[]" placeholder="Modelo">
            </td>
            <td>
              <input class="form-control" type="text" name="ns[]" placeholder="N/S">
            </td>
            <td>
              <input class="form-control" type="text" name="caracteristicas[]" placeholder="Caracteristicas">
            </td>
            <td>
              <input class="form-control" type="text" name="estado[]" placeholder="Estado">
            </td>
            <td>
              <input class="form-control d-none" type="text" name="id_empleado[]" value="{{ $id_empleado }}">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="form-group">
    <button type="button" class="btn btn-success mb-2" onclick="agregarFila()">Agregar Fila</button>
  </div>
  <div class="box-footer text-center">
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
</div>
<script>
  function agregarFila() {
    document.getElementById("table").insertRow(-1).innerHTML = `<td>
              <input class="form-control" type="text" name="marca[]" placeholder="Marca">
            </td>
            <td>
              <input class="form-control" type="text" name="tipo[]" placeholder="Tipo">
            </td>
            <td>
              <input class="form-control" type="text" name="modelo[]" placeholder="Modelo">
            </td>
            <td>
              <input class="form-control" type="text" name="ns[]" placeholder="N/S">
            </td>
            <td>
              <input class="form-control" type="text" name="caracteristicas[]" placeholder="Caracteristicas">
            </td>
            <td>
              <input class="form-control" type="text" name="estado[]" placeholder="Estado">
            </td>
            <td>
              <input class="form-control d-none" type="text" name="id_empleado[]" value="{{ $id_empleado }}">
            </td>`;
  }
</script>
