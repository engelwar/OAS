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
<form method="POST" action="{{ route('rendicionfondofijo.store') }}">
  @csrf
  <div class="container-fluid">
  <div><h3 class="text-center font-weight-light mt-4">LIBRETA DE FONDO FIJO</h3>
  <div><h3 class="text-center font-weight-light mb-4">{{Auth::user()->perfiles->sucursal}}</h3>
</div>
<div style="overflow-x:auto;">
<div  class="table-responsive">
          <table class="table table-sm table-bordered" id="tabla">
           <thead style="text-align: center;">
              <th style="vertical-align: middle;">Fecha</th>
              <th style="vertical-align: middle; min-width: 90px;">Centro de costo</th>
              <th style="vertical-align: middle; min-width: 90px;">Cuenta Contable</th>
              <th style="vertical-align: middle; min-width: 180px;">Responsable</th>
              <th style="vertical-align: middle; min-width: 180px;">Nombre o razón social</th>
              <th style="vertical-align: middle; min-width: 180px;">Concepto</th>
              <th style="vertical-align: middle;table-layout: fixed;min-width:100px">No. Factura o Documento</th>
              <th style="vertical-align: middle;table-layout: fixed;min-width: 100px;">No. Recibo</th>
              <th style="vertical-align: middle;table-layout: fixed;min-width: 80px;">Debe</th>
              <th style="vertical-align: middle;table-layout: fixed;min-width: 80px;">Haber</th>
              <th style="vertical-align: middle;table-layout: fixed;min-width: 80px;">Saldo</th>
           </thead>
           <tbody id="tablab">
             @for($i=0;$i<=5;$i++)
            <tr>
                <td><input id="fecha[]" type="date" value="{{date('Y-m-d')}}" class="form-control form-control-sm @error('fecha') is-invalid @enderror" name="fecha[]"></td>
                <td><input id="centro_c[]" type="text" class="form-control form-control-sm @error('centro_c') is-invalid @enderror" name="centro_c[]"></td>
                <td><input id="cuenta_c[]" type="text" class="form-control form-control-sm @error('cuenta_c') is-invalid @enderror" name="cuenta_c[]"></td>
                <td><input type="text" class="form-control form-control-sm" value="{{Auth::user()->nombre[0].'. '.Auth::user()->paterno}}"></td>
                <td ><input id="razon_s[]" type="text" class="form-control form-control-sm @error('razon_s') is-invalid @enderror" name="razon_s[]"></td>
                <td ><input id="concepto[]" type="text" class="form-control form-control-sm @error('concepto') is-invalid @enderror" name="concepto[]"></td>
                <td ><input id="n_fac[]" type="text" class="form-control form-control-sm @error('n_fac') is-invalid @enderror" name="n_fac[]"></td>
                <td ><input id="n_recib[]" type="text" class="form-control form-control-sm @error('n_recib') is-invalid @enderror" name="n_recib[]"></td>
                <td ><input id="debe[]" type="text" class="debe form-control form-control-sm @error('debe') is-invalid @enderror" name="debe[]"></td>
                <td ><input id="haber[]" type="text" class="haber form-control form-control-sm @error('haber') is-invalid @enderror" name="haber[]"></td>
                <td ><input id="saldo[]" type="text" class="saldo form-control form-control-sm @error('saldo') is-invalid @enderror" name="saldo[]"></td>            
            </tr>
            @endfor
            <tr id="row" class="fila dis_none">
              <td><input id="fecha[]" type="date" value="{{date('Y-m-d')}}" class="form-control form-control-sm @error('fecha') is-invalid @enderror" name="fecha[]"></td>
              <td><input id="centro_c[]" type="text" class="form-control form-control-sm @error('centro_c') is-invalid @enderror" name="centro_c[]"></td>
              <td><input id="cuenta_c[]" type="text" class="form-control form-control-sm @error('cuenta_c') is-invalid @enderror" name="cuenta_c[]"></td>
              <td><input type="text" class="form-control form-control-sm" value="{{Auth::user()->nombre[0].'. '.Auth::user()->paterno}}"></td>
              <td ><input id="razon_s[]" type="text" class="form-control form-control-sm @error('razon_s') is-invalid @enderror" name="razon_s[]"></td>
              <td ><input id="concepto[]" type="text" class="form-control form-control-sm @error('concepto') is-invalid @enderror" name="concepto[]"></td>
              <td ><input id="n_fac[]" type="text" class="form-control form-control-sm @error('n_fac') is-invalid @enderror" name="n_fac[]"></td>
              <td ><input id="n_recib[]" type="text" class="form-control form-control-sm @error('n_recib') is-invalid @enderror" name="n_recib[]"></td>
              <td ><input id="debe[]" type="text" class="debe form-control form-control-sm @error('debe') is-invalid @enderror" name="debe[]"></td>
              <td ><input id="haber[]" type="text" class="haber form-control form-control-sm @error('haber') is-invalid @enderror" name="haber[]"></td>
              <td ><input id="saldo[]" type="text" class="saldo form-control form-control-sm @error('saldo') is-invalid @enderror" name="saldo[]"></td>            
          </tr>            
          </tbody>
          <footer>
            <tr >
              <td style="border: none;" colspan="7"></td>
              <td colspan="2">Total Asignado</td>
              <td colspan="2"><input id="total_asignado" type="text" class="form-control form-control-sm @error('total_asignado') is-invalid @enderror" name="total_asignado"></td>
            </tr>
            <tr >
              <td style="border: none;" colspan="7"></td>
              <td colspan="2">Saldo Final</td>
              <td colspan="2"><input id="total_asignado" type="text" class="form-control form-control-sm @error('total_asignado') is-invalid @enderror" name="total_asignado"></td>
            </tr>
            <tr >
              <td style="border: none;" colspan="7"></td>
              <td colspan="2">Total a Reponer</td>
              <td colspan="2"><input id="total_asignado" type="text" class="form-control form-control-sm @error('total_asignado') is-invalid @enderror" name="total_asignado"></td>
            </tr>
          </footer>
        </table>
      </div>
      </div>
      <a class="first add-row btn btn-primary btn-xs text-light" style="position: fixed;bottom: 10px; left: 80px;">Añadir</a>
</div>
  <div class="cd-flex justify-content-center" style="position: fixed;bottom: 10px; left: 10px;">
      <button type="submit" class="btn btn-primary">
          {{ __('Enviar') }}
      </button>
  </div>
  
</form>
 

@endsection
@section('mis_scripts')
<script>
  $(".add-row").click(function()
  {
    var row = document.getElementById("row"); // find row to copy
    var table = document.getElementById("tablab"); // find table to append to
    var clone = row.cloneNode(true); // copy children too
    table.appendChild(clone); // add new row to end of table
    $(".fila").removeClass("dis_none");
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