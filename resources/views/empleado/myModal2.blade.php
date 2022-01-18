<!-- Modal -->
<div class="modal fade" id="myModal2{{ $empleado->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" method="post">
			@csrf
      <div class="modal-content" style="width: 150%">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex flex-row">
            <select class="form-select g-col-4" aria-label="Default select example">
              <option selected>Tipo de Equipo</option>
              <option value="1">CPU</option>
              <option value="2">Laptop</option>
            </select>
            <input class="form-control g-col-4" type="text" name="" id="" placeholder="IP">
            <select class="form-select" aria-label="Default select example">
              <option selected>Funcional</option>
              <option value="1">Si</option>
              <option value="2">No</option>
            </select>
          </div>
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
                    <input class="form-control" type="text" name="id_empleado[]" value="{{ $empleado->id }}">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-success mb-2" onclick="agregarFila()">Agregar Fila</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </form>
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
              <input class="form-control" type="text" name="id_empleado[]" value="{{ $empleado->id }}">
            </td>`;
  }
</script>