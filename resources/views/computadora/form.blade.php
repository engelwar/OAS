<div class="box box-info padding-1">
    <div class="box-body">
        
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
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>