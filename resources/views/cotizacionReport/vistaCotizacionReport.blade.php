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


<div class="container border rounded col-12 p-10">
        <div class="row pt-5 border-primary" style="margin-top:10px; border-top: solid;">
            <div class="col-12 d-flex justify-content-center"><h3>COTIZACIONES</h3></div>
        </div>
          <div class="row ">
            <div class="col d-flex justify-content-center">
              <p>
                DATO 1 <span  class="text-info"><i class="text-info  fas fa-check fa-lg"></i></span> 
                DATO 2 <span class="text-danger"><i class="fa-lg text-danger fas fa-times"></i></span> 
                DATO 3 <span><i class="fa-lg text-adjud fas fa-handshake"></i></span>
                DATO 4 <span class="text-warning"><i class="fas fa-star-half text-success fa-lg"></i></span>
                DATO 5 <span class="text-success"><i class="fas fa-star text-success fa-lg"></i></span>
              </p>
            </div>
          </div>
         
          <!---------------------botones ------------------------------------>
          <div class="container">
                <div class="row vh-50 justify-content-around align-items-center ">
                    <div class="col-auto">
                       <!-- <button type="button" class="btn btn-primary btn-lg">Ver informe</button>-->
                             <button class="btn btn-primary btn-lg" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                          Ver informe
                             </button>
                    </div>
                    <div class="col-auto">
                    <a class="btn btn-secondary btn-lg" href="{{ route('ReportePDF') }}">Generar PDF</a>
                        
                        
                    </div>
                </div>
            </div> 
            <br>
           

            <div class="table-responsive text-center collapse " id="collapseExample">
                <table class="table table-bordered table-sm">
                <thead class="bg-primary text-light">
                <th style="width: 130px; ">Fecha Cot</th>
                <th style="width: 100px;">Nro Cot</th>
                <th style="width: 150px;">Cliente</th> 
                <th style="width: 300px;">Fecha NR</th> 
                <th style="width: 3000px;">NR</th>
                <th style="width: 330px;" >Total ventas</th>                
                <th style="width: 130px;">Moneda</th>
                <th style="width: 30px;">Usuario vendedor</th>
                <th style="width: 30px;">Local</th>
                <th style="width: 30px;">Fecha fac</th>
                <th style="width: 30px;">Nro Factura</th>
                <th style="width: 30px;">Estado</th>
                <th style="min-width: 120px; max-width: 120px;" colspan="3">Opcervacion</th>
             </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">02/02/22</td>
                            <td class="align-middle">000001</td>
                            <td class="align-middle">wil smith</td>
                            <td class="align-middle">02/03/22</td>
                            <td class="align-middle">hdahdah</td>
                            <td class="align-middle">1000</td>
                            <td class="align-middle">bs</td>
                            <td class="align-middle">el marianas</td>
                            <td class="align-middle">mariscal</td>
                            <td class="align-middle">02/02/22</td>
                            <td class="align-middle">1378413</td>
                            <td class="align-middle">V</td>
                            <td class="align-middle">
                        <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  +
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Observacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Scrollable modal -->
        <!-- Vertically centered scrollable modal -->
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
             Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fuga cum neque doloremque excepturi enim accusantium aliquid laborum ducimus ullam libero suscipit, fugit harum, quidem atque, doloribus soluta. Nobis, aliquam ex?
            </div>
              <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
          </div>
    </div>
  </div>
</div>
                        </tr>
                    </tbody>
                </table>

           </div> 
        

</div>

@endsection






