<!-- Modal -->
<div class="modal fade" id="myModal{{ $equipo->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('equipos.traspaso', $equipo->id) }}" method="post">
			@csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Traspaso de Equipo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input class="d-none" type="text" name="marca" value="{{ $equipo->marca }}">
            <input class="d-none" type="text" name="tipo" value="{{ $equipo->tipo }}">
            <input class="d-none" type="text" name="modelo" value="{{ $equipo->modelo }}">
            <input class="d-none" type="text" name="ns" value="{{ $equipo->ns }}">
            <input class="d-none" type="text" name="caracteristicas" value="{{ $equipo->caracteristicas }}">
            <input class="d-none" type="text" name="estado" value="{{ $equipo->estado }}">
            <select class="form-select" multiple aria-label="multiple select example" name="id_empleado" required>
              {{-- <option selected>Seleccionar empleado</option> --}}
              @foreach ($todos as $todo)
              @if ($todo->paterno != $equipo->empleado->paterno)
              <option value="{{ $todo->id }}">{{ $todo->paterno }} {{ $todo->materno }}, {{ $todo->nombre }}</option>
              @endif
              @endforeach
            </select>
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
