@extends('layouts.app')

@section('estilo')
 <style>
   .form-control
   {
     padding:0px;
   }
   .dis_none
   {
     display: none;
   }
 </style>
@endsection

@section('content')
<table class="fila dis_none">
<tr id="row" class="fila dis_none">
              <td><input id="fecha[]" type="date" style="width: 121px;" value="{{date('Y-m-d')}}" class="form-control form-control-sm @error('fecha') is-invalid @enderror" name="fecha[]"></td>
              <td>
                <select id="centro_c[0]" type="text" class="form-control  form-control-sm" name="centro_c[0]" required>
                    <option disabled selected value="">Centro de Costo</option>
                    <option value="Casa Matriz">Casa Matriz</option>
                    <option value="Mariscal">Mariscal</option>
                    <option value="Handal">Handal</option>
                    <option value="Calacoto">Calacoto</option>
                    <option value="Administracion">Administracion</option>
                    <option value="Almacen Central">Almacen Central</option>
                    <option value="Planta el Alto">Planta el Alto</option>
                    <option value="Santa Cruz">Santa Cruz</option>
                </select>                                            
              </td>
              <td>
                <select id="cuenta_c[0]" type="text" class="form-control  form-control-sm" name="cuenta_c[0]" required>
                    <option disabled selected value="">Tipo de gasto</option>
                    <option value="Movilidad">Movilidad</option>
                    <option value="Trans. Flete">Trans. Flete</option>
                    <option value="Mantenimiento de Equipos">Mantenimiento de Equipos</option>
                    <option value="Servicio de te">Servicio de te</option>
                    <option value="Refrigerios">Refrigerios</option>
                    <option value="Refrigerios">Fotocopias</option>
                    <option value="Gastos varios">Gastos varios</option>
                    <option value="Material de Limpieza">Material de limpieza</option>
                </select>
              </td>
              <td><input type="text" class="form-control form-control-sm" value="{{Auth::user()->perfiles->nombre[0].'. '.Auth::user()->perfiles->paterno}}"></td>
              <td ><input id="razon_s[]" type="text" class="form-control form-control-sm @error('razon_s') is-invalid @enderror" name="razon_s[]"></td>
              <td ><input id="concepto[]" type="text" class="form-control form-control-sm @error('concepto') is-invalid @enderror" name="concepto[]"></td>
              <td ><input id="n_fac[]" type="text" class="form-control form-control-sm @error('n_fac') is-invalid @enderror" name="n_fac[]"></td>
              <td ><input id="n_recib[]" type="text" class="form-control form-control-sm @error('n_recib') is-invalid @enderror" name="n_recib[]"></td>
              <td ><input id="debe[]" type="text" class="text-right debe form-control form-control-sm @error('debe') is-invalid @enderror" name="debe[]"></td>
              <td ><input id="haber[]" type="text" class="text-right haber form-control form-control-sm @error('haber') is-invalid @enderror" name="haber[]"></td>
              <td ><input type="text" class="text-right saldo form-control form-control-sm @error('saldo') is-invalid @enderror"></td>            
            </tr> 
</table>
<div class="container-fluid">
  <ul class="nav nav-pills mb-3 mt-4" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Solicitudes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Fondo Fijo</a>
    </li>   
    <li class="nav-item">
      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Fondo Fijo Total</a>
    </li> 
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <form method="POST" action="{{ route('rendicionfondofijo.update', $form->id) }}">
        @csrf
        <h4 class="text-center font-weight-light mt-2">LIBRETA DE FONDO FIJO</h4>
        <h3 class="text-center font-weight-light mb-4">{{$form->unidad}}</h3>
        <div class="row my-4">
          <div class="col-2">
            <select id="usuario" type="text" class="form-control  form-control-sm" name="usuario" required>
              <option disabled selected value="">Usuario Responsable</option>  
              @if($users->count())
                @foreach($users as $u)                  
                  <option value="{{$u->id}}" @if($u->id == $form->user_id) selected @endif>{{$u->perfiles->nombre .' '. $u->perfiles->paterno}}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <input name="_method" type="hidden" value="PATCH">
        <table class="table table-sm table-bordered" id="tabla">
          <thead style="text-align: center;">
            <th style="vertical-align: middle; min-width: 121px;">Fecha</th>
            <th style="vertical-align: middle; min-width: 90px;">Centro de costo</th>
            <th style="vertical-align: middle; min-width: 90px;">Cuenta Contable</th>
            <th style="vertical-align: middle; min-width: 90px;">Responsable</th>
            <th style="vertical-align: middle; min-width: 180px;">Nombre o razón social</th>
            <th style="vertical-align: middle; min-width: 180px;">Concepto</th>
            <th style="vertical-align: middle;table-layout: fixed; width: 80px">No Factura</th>
            <th style="vertical-align: middle;table-layout: fixed; width: 80px;">No Recibo</th>
            <th style="vertical-align: middle;table-layout: fixed; width: 80px;">Debe</th>
            <th style="vertical-align: middle;table-layout: fixed; width: 80px;">Haber</th>
            <th style="vertical-align: middle;table-layout: fixed;width: 80px;">Saldo</th>
          </thead>
          <tbody id="tablab">
            @if($valid!=NULL)
            @foreach($valid as $d)
            <tr class="operacion">
            <td>{{$d->fecha}}</td>
              <td>{{$d->centro_c}}</td>
              <td>{{$d->cuenta_c}}</td>
              <td>{{$d->user->perfiles->nombre[0]}}. {{$d->user->perfiles->paterno}}</td>
              <td>{{$d->razon_s}}</td>
              <td>{{$d->concepto}}</td>
              <td>{{$d->n_fac}}</td>
              <td>{{$d->n_recib}}</td>
              <td class="debe">{{$d->debe}}</td>
              <td class="haber">{{$d->haber}}</td>
              <td class="saldo"></td>
            </tr>
            @endforeach
            @endif                       
          </tbody>
          <footer>
            <tr >
              <td style="border: none;" colspan="7"></td>
              <td colspan="2">Total Asignado</td>
              <td colspan="2"><input id="total_asignado" value="{{$form->total_asignado}}" type="text" class="text-right form-control form-control-sm @error('total_asignado') is-invalid @enderror" name="total_asignado"></td>
            </tr>
            <tr >
              <td style="border: none;" colspan="7"></td>
              <td colspan="2">Saldo Final</td>
              <td colspan="2"><input id="total_asignado" value="{{$form->saldo_final}}" type="text" class="text-right form-control form-control-sm @error('total_asignado') is-invalid @enderror" name="total_asignado"></td>
            </tr>
            <tr >
              <td style="border: none;" colspan="7"></td>
              <td colspan="2">Total a Reponer</td>
              <td colspan="2"><input id="total_asignado" value="{{$form->total_reponer}}" type="text" class="text-right form-control form-control-sm @error('total_asignado') is-invalid @enderror" name="total_asignado"></td>
            </tr>
          </footer>
        </table>  
        <div class="cd-flex justify-content-center" style="position: fixed;bottom: 10px; left: 10px;">
          <button type="submit" class="btn btn-primary">
            {{ __('Guardar') }}
          </button>
        </div>
        <a class="first add-row btn btn-primary btn-xs text-light" style="position: fixed;bottom: 10px; left: 100px;">Añadir</a>             
        <a class="btn btn-primary btn-xs text-light" style="position: fixed;bottom: 10px; left: 180px;" href="{{action('RendicionFondoFijoController@pdf', $form->id)}}">Imprimir</a>
      </form>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <div class="table-responsive">
        <table class="table table-sm table-bordered" id="tabla">
          <thead style="text-align: center;">
              <th style="vertical-align: middle; min-width: 90px;">Fecha</th>
              <th style="vertical-align: middle; min-width: 90px;">Centro de costo</th>
              <th style="vertical-align: middle; min-width: 90px;">Cuenta Contable</th>
              <th style="vertical-align: middle; min-width: 90px;">Responsable</th>
              <th style="vertical-align: middle; min-width: 180px;">Nombre o razón social</th>
              <th style="vertical-align: middle; min-width: 180px;">Concepto</th>
              <th style="vertical-align: middle;table-layout: fixed; width: 80px">No Factura</th>
              <th style="vertical-align: middle;table-layout: fixed; width: 80px;">No Recibo</th>
              <th style="vertical-align: middle;table-layout: fixed; width: 80px;">Debe</th>
              <th style="vertical-align: middle;table-layout: fixed; width: 80px;">Haber</th>
              <th style="vertical-align: middle;table-layout: fixed;width: 80px;">Saldo</th>
              <th style="vertical-align: middle;table-layout: fixed;width: 80px;" colspan="2"></th>
          </thead>
          <tbody>
            @if($data!=NULL)
            @foreach($data as $d)
            <tr>
              <td>{{$d->fecha}}</td>
              <td>{{$d->centro_c}}</td>
              <td>{{$d->cuenta_c}}</td>
              <td>{{$d->user->perfiles->nombre[0]}}. {{$d->user->perfiles->paterno}}</td>
              <td>{{$d->razon_s}}</td>
              <td>{{$d->concepto}}</td>
              <td>{{$d->n_fac}}</td>
              <td>{{$d->n_recib}}</td>
              <td>{{$d->debe}}</td>
              <td>{{$d->haber}}</td>
              <td></td>
              <td><a href="{{action('RendicionFondoFijoController@validar', $d->id)}}" ><span class="glyphicon glyphicon-pencil"><i class="fas fa-check-square"></i></a></td>
              <td><a href="{{action('RendicionFondoFijoController@denegar', $d->id)}}" ><span class="glyphicon glyphicon-pencil"><i class="fas fa-times"></i></a></td>
            </tr>
            @endforeach              
            @endif         
          </tbody>          
        </table>                       
      </div>       
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
    <div class="row pb-3">
            <div class="col"><h3>LIBRETAS DE FONDO FIJO <!--a href="{{ route('rendicionfondofijo.create') }}" >+</a--></h3></div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-sm table-bordered" >
             <thead>
                <th style="width: 30%">Unidad</th>
                <th>Fecha de Inicio</th>
                <th colspan="2" style="width: 15%;">Opciones</th>
             </thead>
             <tbody>
              @if($forms->count())
              @foreach($forms as $f)
              <tr>
                <td>{{$f->unidad}}</td>
                <td>{{$f->fecha_ini}}</td>
                <td><a class="btn btn-primary btn-sm" href="{{action('RendicionFondoFijoController@edit', $f->id)}}" ><span class="glyphicon glyphicon-pencil">Detalle</span></a></td>
               </tr>
               @endforeach
               @else
               <tr>
                <td>No hay registro !!</td>
              </tr>
              @endif
            </tbody>
          </table>
          {{ $forms->links() }}
        </div>
    </div>
  </div>    
</div>
 

  

@endsection
@section('mis_scripts')
<script>
  $(document).ready(function(){
    var TotalValue = 0;
    var debe = 0;
    $(".operacion").each(function(){        
          debe = parseFloat($(this).find("td.debe").text());
          haber = parseFloat($(this).find("td.haber").text());
          saldo = parseFloat($(this).find("td.saldo").text());
          if(typeof saldoant == 'undefined')
          {
            saldo=0;
            saldoant=0;
          }
          if(isNaN(debe))
          {
            debe = 0;
          }
          //$(this).find("td.debe").text(debe);
          $(this).find("td.saldo").text(saldoant+debe-haber);
          saldoant =  parseFloat($(this).find("td.saldo").text());
          //TotalValue = TotalValue + parseFloat($(this).text());
          console.log(debe);
    });
});
  $(".add-row").click(function()
  {
    var row = document.getElementById("row"); // find row to copy
    var table = document.getElementById("tablab"); // find table to append to
    var clone = row.cloneNode(true); // copy children too
    clone.classList.add('nueva');
    table.appendChild(clone); // add new row to end of table
    //new.addClass('nueva');
    $(".nueva").removeClass("dis_none nueva");
    //$("table#tabla tbody").append(markup);
    //$(" #cont").val(cont);
  });

  var num = 2;
  //var test = $('tr:nth-child('+num+') td:last-child .saldo').val("fasfasfas");
 function sumamodal() 
 {
    // Para suma de montos
    var total = 0;
        $(".saldo").each(function () {
            var vp_v = $(this).val();

            if (isNaN(parseFloat(vp_v))) {
                total += 0;
            } else {
                total += parseFloat(vp_v);
            }
        });
        total_fixed = total.toFixed(2);
        total_fixed = parseFloat(total_fixed + 0);
    $('#total').val(total_fixed);
  }

  $(document).on('keyup','.saldo',function()
  {
    sumamodal();
  });
</script>
@endsection