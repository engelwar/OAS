<!-- Modal -->
<div class="modal fade" id="myModal2{{ $empleado->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('computadoras.store') }}" method="POST">
			@csrf
      <div class="modal-content" style="width: 150%">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex flex-row">
            <select class="form-select" aria-label="Default select example" name="tipo">
              <option selected>Tipo de Equipo</option>
              <option value="cpu">CPU</option>
              <option value="laptop">Laptop</option>
            </select>
            <input class="form-control" type="text" name="ip" id="" placeholder="IP">
            <select class="form-select" name="funcional" aria-label="Default select example">
              <option selected>Funcional</option>
              <option value="si">Si</option>
              <option value="no">No</option>
            </select>
            <input class="" type="text" name="id_empleado" id="id_empleado" value="{{ $empleado->id }}">
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