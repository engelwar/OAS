<div class="box box-info padding-1">
  <div class="card-body">
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
              <input class="form-control" type="text" name="marca" placeholder="Marca" value="{{ $equipos->marca }}">
            </td>
            <td>
              <input class="form-control" type="text" name="tipo" placeholder="Tipo" value="{{ $equipos->tipo }}">
            </td>
            <td>
              <input class="form-control" type="text" name="modelo" placeholder="Modelo" value="{{ $equipos->modelo }}">
            </td>
            <td>
              <input class="form-control" type="text" name="ns" placeholder="N/S" value="{{ $equipos->ns }}">
            </td>
            <td>
              <input class="form-control" type="text" name="caracteristicas" placeholder="Caracteristicas" value="{{ $equipos->caracteristicas }}">
            </td>
            <td>
              <input class="form-control" type="text" name="estado" placeholder="Estado" value="{{ $equipos->estado }}">
            </td>
            <td class="d-none">
              <input class="form-control" type="text" name="id_empleado" placeholder="id_empleado" value="{{ $equipos->id_empleado }}">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="box-footer mt20">
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
</div>
