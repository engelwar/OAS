@extends('layouts.app')
@section('title', 'Inicio')
@section('mi_estilo')
<style>
.file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}
.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #355296;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #355296;
  border: 4px dashed #ffffff;
  color: #fff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}
.bg-adjud
{
  background-color: coral;
}
.text-adjud
{
  color: coral;
}
.linea{
    height: 2px;
  background-color: rgb(36, 34, 34);
}
.linea2{
    height: 3px;
  background-color: rgb(78, 71, 71);
}
.linea3{
    height: 3px;
  background-color: rgb(78, 71, 71);
  border-style: inherit;
}
</style>
@endsection
@section('content') 

    <div class="container border rounded col-12 p-4">
      
          <div class="row p-1">
            <div class="col-12 d-flex justify-content-center"><h3>REGISTRO DE DISPOSITIVOS</h3></div>
          </div>


       <div style="position: relative;">
        <div style="align-items: center;">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Registro de PC  <i class="fa fa-desktop" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@getbootstrap">Registro de laptop <i class="fa fa-laptop" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@getbootstrap">Registro de tablet <i class="fa fa-tablet" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal4" data-bs-whatever="@fat">Registro de Celular <i class="fa fa-phone-square" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal5" data-bs-whatever="@getbootstrap">Registro de impresora <i class="fa fa-print" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal6" data-bs-whatever="@getbootstrap">Router <i class="fa fa-wifi" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal7" data-bs-whatever="@getbootstrap">Lector de barras <i class="fa fa-barcode" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal8" data-bs-whatever="@getbootstrap">Otros <i class="fa fa-pied-piper" aria-hidden="true"></i></button>
        
        </div>
        
      </div>   
      
    </div>   
    
    


    {{-- ventana modal 1 --}}
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Registro PC</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate>
                    <div class="col-md-4">
                      <label for="validationCustom01" class="form-label">ID</label>
                      <input type="text" class="form-control" id="validationCustom02" value="" required>
                      <div class="valid-feedback">
                        dato Correcto!
                      </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Tarjeta madre</label>
                        <input type="text" class="form-control" id="validationCustom02" value="" required>
                        <div class="valid-feedback">
                          dato Correcto!
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Procesador</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>CORE DUO</option>
                          <option>i3</option>
                          <option>i5</option>
                          <option>i7</option>
                          <option>Pentium Gold</option>
                          <option>AMD</option>
                          <option>A9</option>
                          <option>XEON</option>
                          <option>ATHOL</option>
                          <option>RYZEN</option>
                          <option>Otro</option>
                          
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                    <hr class="linea">
                    <span style="font-size: 1em">DiscoDuro</span>

                    <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Tipo</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>HDD</option>
                          <option>SDD</option>
                          <option>Otro</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>


                    <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Capacidad</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>480 - 512</option>
                          <option>960 - 1024</option>
                          <option>Otro</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Unidad</label>
                        <input disabled type="text" class="form-control" id="validationCustom03" value="GB" required>
                        <div class="valid-feedback">
                          dato Correcto!
                        </div>
                      </div>
                      <hr class="linea2">
                      <span style="font-size: 1em">RAM</span>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Capcidad</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>1</option>
                          <option>2</option>
                          <option>4</option>
                          <option>8</option>
                          <option>16</option>
                          <option>otro</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Precuencia</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>DDR2</option>
                          <option>DDR3</option>
                          <option>Otro</option>
                          
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Unidad</label>
                        <input disabled type="text" class="form-control" id="validationCustom03" value="GB" required>
                        <div class="valid-feedback">
                          dato Correcto!
                        </div>
                      </div>
                     
                      <span style="font-size: 1em">Memoria ram slot 2</span>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Capcidad</label>
                        <select class="form-select" id="validationCustom04" required>
                          
                          <option value="Slot libre" >Slot libre</option>
                          <option>1</option>
                          <option>2</option>
                          <option>4</option>
                          <option>8</option>
                          <option>16</option>
                          <option>otro</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Precuencia</label>
                        <select class="form-select" id="validationCustom04" required>
                         
                          <option value="Slot libre" >Slot libre</option>
                          <option>DDR2</option>
                          <option>DDR3</option>
                          <option>Otro</option>
                          
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Unidad</label>
                        <input disabled type="text" class="form-control" id="validationCustom03" value="GB" required>
                        <div class="valid-feedback">
                          dato Correcto!
                        </div>
                      </div>
                      <hr class="line">
                 
                      <span style="font-size: 1em">GPU</span>
                      <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Caracteristicas</label>
                        <input type="text" class="form-control" id="validationCustom04" value="intek(R) UHD Graphic" required>
                        <div class="valid-feedback">
                          dato Correcto!
                        </div>
                      </div>

                    <div class="col-md-4">
                      <label for="validationCustom02" class="form-label">Tamaño</label>
                      <input type="text" class="form-control" id="validationCustom02" value=" 2 GB" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                
                  
                   
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="NO" id="invalidCheck">
                        <label class="form-check-label" for="invalidCheck">
                          Notiene 
                        </label>
                        <div class="invalid-feedback">
                          You must agree before submitting.
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary" type="submit">Registrar</button>
                    </div>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
           
            </div>
          </div>
        </div>
      </div>

      {{-- modallaptop --}}
      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Registro laptop</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate>
                    <div class="col-md-4">
                      <label for="validationCustom01" class="form-label">ID</label>
                      <input type="text" class="form-control" id="validationCustom02" value="" required>
                      <div class="valid-feedback">
                        dato Correcto!
                      </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">S/N</label>
                        <input type="text" class="form-control" id="validationCustom02" value="" required>
                        <div class="valid-feedback">
                          dato Correcto!
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Tipo</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>Laptop</option>
                          <option>Notebook</option>
                          <option>Ultrabook</option>
                          <option>Otra</option>
                         </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Procesador</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>CORE DUO</option>
                          <option>i3</option>
                          <option>i5</option>
                          <option>i7</option>
                          <option>Pentium Gold</option>
                          <option>AMD</option>
                          <option>A9</option>
                          <option>XEON</option>
                          <option>ATHOL</option>
                          <option>RYZEN</option>
                          <option>Otro</option>
                          
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                  
                    

                    <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">DiscoDuro</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>HDD</option>
                          <option>SDD</option>
                          <option>Otro</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>


                    <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Capacidad</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>480 - 512 [GB]</option>
                          <option>960 - 1024 [GB]</option>
                          <option>Otro</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                  
                      <hr class="linea2">
                      <span style="font-size: 1em">RAM</span>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Capcidad</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>1 [GB]</option>
                          <option>2 [GB]</option>
                          <option>4 [GB]</option>
                          <option>8 [GB]</option>
                          <option>16 [GB]</option>
                          <option>otro</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Precuencia</label>
                        <select class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Tipo...</option>
                          <option>DDR2</option>
                          <option>DDR3</option>
                          <option>Otro</option>
                          
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                   
                     
                      <span style="font-size: 1em">Memoria ram slot 2</span>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Capcidad</label>
                        <select class="form-select" id="validationCustom04" required>
                          
                          <option value="Slot libre" >Slot libre</option>
                          <option>1 [GB]</option>
                          <option>2 [GB]</option>
                          <option>4 [GB]</option>
                          <option>8 [GB]</option>
                          <option>16 [GB]</option>
                          <option>otro</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Precuencia</label>
                        <select class="form-select" id="validationCustom04" required>
                         
                          <option value="Slot libre" >Slot libre</option>
                          <option>DDR2</option>
                          <option>DDR3</option>
                          <option>Otro</option>
                          
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid state.
                        </div>
                      </div>
                   
                      <hr class="line">
                 
                      <span style="font-size: 1em">GPU</span>
                      <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Caracteristicas</label>
                        <input type="text" class="form-control" id="validationCustom04" value="intek(R) UHD Graphic" required>
                        <div class="valid-feedback">
                          dato Correcto!
                        </div>
                      </div>

                    <div class="col-md-4">
                      <label for="validationCustom02" class="form-label">Tamaño</label>
                      <input type="text" class="form-control" id="validationCustom02" value=" 2 GB" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                
                  
                   
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="NO" id="invalidCheck">
                        <label class="form-check-label" for="invalidCheck">
                          Notiene 
                        </label>
                        <div class="invalid-feedback">
                          You must agree before submitting.
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary" type="submit">Registrar</button>
                    </div>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
           
            </div>
          </div>
        </div>
      </div>

{{-- modal table --}}
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro tablet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form class="row g-3 needs-validation" novalidate>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label">ID</label>
                <input type="text" class="form-control" id="validationCustom02" value="" required>
                <div class="valid-feedback">
                  dato Correcto!
                </div>
              </div>
              <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">S/N</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">IMEI</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Marca</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">RAM</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">ROM</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Color</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
          
          

          
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Registrar</button>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
     
      </div>
    </div>
  </div>
</div>

{{-- modal celular --}}
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro celular</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form class="row g-3 needs-validation" novalidate>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label">ID</label>
                <input type="text" class="form-control" id="validationCustom02" value="" required>
                <div class="valid-feedback">
                  dato Correcto!
                </div>
              </div>
        
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">IMEI</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Modelo</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>

                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Marca</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">RAM</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">ROM</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Color</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
          
          

          
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Registrar</button>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
     
      </div>
    </div>
  </div>
</div>

{{-- modal impresora--}}
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro impresora</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form class="row g-3 needs-validation" novalidate>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label">ID</label>
                <input type="text" class="form-control" id="validationCustom02" value="" required>
                <div class="valid-feedback">
                  dato Correcto!
                </div>
              </div>
        
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Marca</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Modelo</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>

                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">S/N</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="validationCustom02" class="form-label">Tipo</label>
                  <select class="form-select" id="validationCustom04" required>
                    <option selected disabled value="">Tipo...</option>
                    <option>Impresora normal</option>
                    <option>Impresora termica</option>
                    <option>Otro</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid state.
                  </div>
                </div>
         <div class="col-12">
                <button class="btn btn-primary" type="submit">Registrar</button>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
     
      </div>
    </div>
  </div>
</div>

{{-- modal router--}}
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro router</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form class="row g-3 needs-validation" novalidate>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label">ID</label>
                <input type="text" class="form-control" id="validationCustom02" value="" required>
                <div class="valid-feedback">
                  dato Correcto!
                </div>
              </div>
        
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Marca</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Modelo</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>

                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">S/N</label>
                  <input type="text" class="form-control" id="validationCustom02" value="" required>
                  <div class="valid-feedback">
                    dato Correcto!
                  </div>
                </div>
          
          
          

          
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Registrar</button>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
     
      </div>
    </div>
  </div>
</div>
@endsection
@section('mis_scripts')
<script>

/// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()


function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}
</script>
@endsection
