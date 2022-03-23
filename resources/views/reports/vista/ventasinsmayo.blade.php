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

</style>
@endsection
@section('content') 

    <div class="container border rounded col-12 p-3">
          <div class="row pt-5 border-primary" style="margin-top:70px; border-top: solid;">
            <div class="col-12 d-flex justify-content-center"><h3>COTIZACIONES</h3></div>
          </div>
          <div class="row ">
            <div class="col d-flex justify-content-center">
              <p>
                Seguimiento <span  class="text-info"><i class="text-info  fas fa-check fa-lg"></i></span> 
                - Rechazado <span class="text-danger"><i class="fa-lg text-danger fas fa-times"></i></span> 
                - Adjudicado <span><i class="fa-lg text-adjud fas fa-handshake"></i></span>
                - Parcial <span class="text-warning"><i class="fas fa-star-half text-success fa-lg"></i></span>
                - Completa <span class="text-success"><i class="fas fa-star text-success fa-lg"></i></span>
              </p>
            </div>
          </div>


          <div class="row pb-4">
            <div class="col">
            </div>
            <div class="col-3 col-sm-9 col-md-7 d-sm-flex justify-content-end">
                
            </div>
            
          </div>
         
          <div class="table-responsive text-center" >
            <table class="table table-bordered table-sm">

             <thead class="bg-primary text-light">
                <th style="width: 130px; ">Fecha</th>
                <th style="width: 100px;">Hora</th>
                <th style="width: 150px;">NIT</th> 
                <th style="width: 300px;">Empresa</th> 
                <th style="width: 160px;">Unidad</th>
                <th style="width: 330px;" >Descripcion</th>
                
                <th style="width: 130px;">Cotizador</th>
                <th style="width: 30px;">S</th>
                <th style="width: 30px;">E</th>
                <th style="min-width: 120px; max-width: 120px;" colspan="3">OPC</th>
             </thead>
              <tbody>
              <tr >
                <td class="align-middle">a</td>
                <td class="align-middle">b</td>
                <td class="align-middle">c</td>
                <td class="align-middle">d</td>
                <td class="align-middle">e</td>
                <td class="align-middle" style="max-width: 330px;overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;">
                </td>                     
                <td class="align-middle">f</td>  
                <td class="align-middle">
                  
                    <i class="fa-lg text-info  fas fa-check"></i> 
                  
                </td>
                <td class="align-middle">
                 
                </td>
                <td class="align-middle" style="min-width: 20px; max-width: 20px;" >
                  
                    <span><i class="fas fa-search"></i></span>
                  </a>
                </td>
              
                <td class="align-middle" style="min-width: 40px; max-width: 40px;">
               

                <!-- Modal NO COMPLETADO-->
                <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Subir Archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                </td>
               </tr>
              </tbody>
                
              
            
          </table>
          </div>
    </div>          
@endsection
@section('mis_scripts')
<script>
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
