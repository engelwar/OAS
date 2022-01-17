@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
<div class="fieldGroupCopy" style="display: none;">
                                            <table class="table table-bordered table-sm" >
                                                <td class="align-middle"><input class="form-control" id="fecha" type="date" name="fecha_h[]" placeholder="MM/DD/AAAA" /></td>
                                                <td><input class="form-control" id="centro" type="text" name="centro_h[]" placeholder="Centro de costo" /></td>
                                                <td><input class="form-control" id="nrofactura" type="text" name="nrofactura_h[]" placeholder="No. Factura" /></td>
                                                <td><input class="form-control" id="nrorecibo" type="text" name="nrorecibo_h[]" placeholder="No. Recibo" /></td>
                                                <td><input class="form-control" id="razonsocial" type="text" name="proveedor_h[]" placeholder="Proveedor" /></td>
                                                <td><input class="form-control" id="importe" name="importe_h[]" type="text" placeholder="Importe"  onchange="SumarSubtotal1(this.value);" /></td>
                                                <td><input class="form-control" id="detalle" type="text" name="detalle_h[]" placeholder="Detalle" /></td>
                                                <td><a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</a></td>
                                            </table>
                                        </div>
                                        <div class="fieldGroupCopy1" style="display: none;">
                                            <table class="table table-bordered table-sm" >
                                                <td class="align-middle"><input class="form-control" id="fecha" type="date" name="fecha_a[]" placeholder="MM/DD/AAAA" /></td>
                                                <td><input class="form-control" id="centro" type="text" name="centro_a[]" placeholder="Centro de costo" /></td>
                                                <td><input class="form-control" id="nrofactura" type="text" name="nrofactura_a[]" placeholder="No. Factura" /></td>
                                                <td><input class="form-control" id="nrorecibo" type="text" name="nrorecibo_a[]" placeholder="No. Recibo" /></td>
                                                <td><input class="form-control" id="razonsocial" type="text" name="proveedor_a[]" placeholder="Proveedor" /></td>
                                                <td><input class="form-control" id="importe" name="importe_a[]" type="text" placeholder="Importe"  onchange="SumarSubtotal2(this.value);" /></td>
                                                <td><input class="form-control" id="detalle" type="text" name="detalle_a[]" placeholder="Detalle" /></td>
                                                <td><a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</a></td>
                                            </table>
                                        </div>
                                        <div class="fieldGroupCopy2" style="display: none;">
                                            <table class="table table-bordered table-sm" >
                                                <td class="align-middle"><input class="form-control" id="fecha" type="date" name="fecha_t[]" placeholder="MM/DD/AAAA" /></td>
                                                <td><input class="form-control" id="centro" type="text" name="centro_t[]" placeholder="Centro de costo" /></td>
                                                <td><input class="form-control" id="nrofactura" type="text" name="nrofactura_t[]" placeholder="No. Factura" /></td>
                                                <td><input class="form-control" id="nrorecibo" type="text" name="nrorecibo_t[]" placeholder="No. Recibo" /></td>
                                                <td><input class="form-control" id="razonsocial" type="text" name="proveedor_t[]" placeholder="Proveedor" /></td>
                                                <td><input class="form-control" id="importe" name="importe_t[]" type="text" placeholder="Importe"  onchange="SumarSubtotal2(this.value);" /></td>
                                                <td><input class="form-control" id="detalle" type="text" name="detalle_t[]" placeholder="Detalle" /></td>
                                                <td><a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</a></td>
                                            </table>
                                        </div>

<form action="{{ route('rendiciongastosviatico.store') }}" method="POST">
@csrf







 <div class="row justify-content-center">
 <div class="col-lg-12">
   <div class="card shadow-lg border-0 rounded-lg mt-5">
  <div class="card-header"><h2 class="text-center font-weight-light my-4"><B>Formulario de rendicion de gastos</B></h2>

  </div>
                                    <div class="card-body">
                                        <form>

                                            <div class="form-group text-center">
                                                <label>Tipo de gasto:</label><br/>
                                                <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="entregas">
                                                      <label class="form-check-label" for="inlineRadio1">Emtregas C/ Rendicion</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="viaticos">
                                                      <label class="form-check-label" for="inlineRadio2">Viaticos</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="otros">
                                                      <label class="form-check-label" for="inlineRadio2">Otros gastos</label>
                                                    </div>

                                            </div>

                                             <div class="form-group">
                                                <label class="small mb-1" for="fech">Saldo</label>
                                                <input class="form-control" id="saldo" name="saldo" type="text" placeholder="Saldo"  onchange="Otorgado(this.value);" />

                                            </div>
                                            <div class="form-group">
                                                <div class="card-body">
                                                    <div class="form-group fieldGroup">
                                                        <label class="" for="fech">Gastos de hospedaje</label>


                                                             <table class="table table-bordered table-sm" >
                                                                  <thead>
                                                                     <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Centro de costo</th>
                                                                        <th>No. Factura</th>
                                                                        <th>No. Recibo</th>
                                                                        <th>Proveedor</th>
                                                                        <th>Importe en BS</th>
                                                                        <th>Detalle del gasto</th>

                                                                        <th>Acciones</th>

                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <tr>
                                                                        <td class="align-middle" ><input class="form-control" id="fecha" type="date" name="fecha_h[]" placeholder="MM/DD/AAAA" /></td>
                                                                        <td><input class="form-control" id="centro" type="text" name="centro_h[]" placeholder="Centro de costo" /></td>
                                                                        <td><input class="form-control" id="nrofactura" type="text" name="nrofactura_h[]" placeholder="No. Factura" /></td>
                                                                        <td><input class="form-control" id="nrorecibo" type="text" name="nrorecibo_h[]" placeholder="No. Recibo" /></td>
                                                                        <td><input class="form-control" id="razonsocial" type="text" name="proveedor_h[]" placeholder="Proveedor" /></td>
                                                                        <td><input class="form-control" id="importe" name="importe_h[]" type="text" placeholder="Importe"  onchange="SumarSubtotal1(this.value);" /></td>
                                                                        <td><input class="form-control" id="detalle" type="text" name="detalle_h[]" placeholder="Detalle" /></td>
                                                                        <td><a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Añadir</a>
                                                                       </td>
                                                                    <tr>
                                                                        <td></td>
                                                                    </tr>

                                                                    </tr>
                                                                </tbody>
                                                            </table>


                                                    </div>
                                                     <table class="table table-bordered table-sm" >


                                                                <tbody>


                                                                   <tr>
                                                                        <td colspan="5"><b> <span >Subtotal:</span></b>
                                                                        </td>
                                                                        <td class="text-right">
                                                                           <b> <span  id="SubTotal1"></span></b>
                                                                        </td>
                                                                    </tr>

                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                    <div class="form-group fieldGroup1">
                                                        <label class="" for="fech">Gastos de alimentacion</label>

                                                        <table class="table table-bordered table-sm" >

                                                                <tbody>
                                                                    <tr>
                                                                        <td class="align-middle" ><input class="form-control" id="fecha" type="date" name="fecha_a[]" placeholder="MM/DD/AAAA" /></td>
                                                                        <td><input class="form-control" id="centro" type="text" name="centro_a[]" placeholder="Centro de costo" /></td>
                                                                        <td><input class="form-control" id="nrofactura" type="text" name="nrofactura_a[]" placeholder="No. Factura" /></td>
                                                                        <td><input class="form-control" id="nrorecibo" type="text" name="nrorecibo_a[]" placeholder="No. Recibo" /></td>
                                                                        <td><input class="form-control" id="razonsocial" type="text" name="proveedor_a[]" placeholder="Proveedor" /></td>
                                                                        <td><input class="form-control" id="importe" name="importe_a[]" type="text" placeholder="Importe"  onchange="SumarSubtotal2(this.value);" /></td>
                                                                        <td><input class="form-control" id="detalle" type="text" name="detalle_a[]" placeholder="Detalle" /></td>
                                                                        <td><a href="javascript:void(0)" class="btn btn-success addMore1"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Añadir</a>
                                                                       </td>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                                     <table class="table table-bordered table-sm" >


                                                                <tbody>


                                                                   <tr>
                                                                        <td colspan="5"><b> <span >Subtotal:</span></b>
                                                                        </td>
                                                                        <td class="text-right">
                                                                           <b> <span  id="SubTotal2"></span></b>
                                                                        </td>
                                                                    </tr>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    <div class="form-group fieldGroup2">
                                                        <label class="" for="fech">Gastos de transporte</label>

                                                        <table class="table table-bordered table-sm" >

                                                                <tbody>
                                                                    <tr>
                                                                        <td class="align-middle" ><input class="form-control" id="fecha" type="date" name="fecha_t[]" placeholder="MM/DD/AAAA" /></td>
                                                                        <td><input class="form-control" id="centro" type="text" name="centro_t[]" placeholder="Centro de costo" /></td>
                                                                        <td><input class="form-control" id="nrofactura" type="text" name="nrofactura_t[]" placeholder="No. Factura" /></td>
                                                                        <td><input class="form-control" id="nrorecibo" type="text" name="nrorecibo_t[]" placeholder="No. Recibo" /></td>
                                                                        <td><input class="form-control" id="razonsocial" type="text" name="proveedor_t[]" placeholder="Proveedor" /></td>
                                                                        <td><input class="form-control" id="importe" name="importe_t[]" type="text" placeholder="Importe"  onchange="SumarSubtotal3(this.value);" /></td>
                                                                        <td><input class="form-control" id="detalle" type="text" name="detalle_t[]" placeholder="Detalle" /></td>
                                                                        <td><a href="javascript:void(0)" class="btn btn-success addMore2"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Añadir</a>
                                                                       </td>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                                     <table class="table table-bordered table-sm" >


                                                                <tbody>


                                                                   <tr>
                                                                        <td colspan="5"><b> <span >Subtotal:</span></b>
                                                                        </td>
                                                                        <td class="text-right">
                                                                           <b> <span  id="SubTotal3"></span></b>
                                                                        </td>
                                                                    </tr>

                                                                    </tr>
                                                                </tbody>
                                                            </table>

                            </div>
<div class="row d-flex justify-content-center">
<div class="card-header">
    <table id="data" >
        <tbody>
            <tr>

                <td><b> <span>TOTAL ACUMULADO /  GASTOS RENDIDOS :</span></b>
                </td>
                <td class="text-right">
                   <b> <span id="TotalS"></span></b>
                </td>
            </tr>
            <tr>
                <td>
                    <b><span >MONTO OTORGADO: </span></b>
                </td>
                <td class="text-right">
                   <b> <span  id="MiSaldo"></span></b>
                </td>
            </tr>


            <tr>

                <td><b> <span>DIFERENCIA </span></b>
                </td>
                <td class="text-right">
                   <b> <span id="MiTotal"></span></b>
                </td>
            </tr>

        </tbody>




    </table>

                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" value="Rendicion de gastos" class="btn btn-primary btn-block" />
                                            </div>
  </div>

</div>
                                            </div>




                                        </form>
                                    </div>
                                </div>
                                <div class="card-header">
                            </div>
                        </div>

</form>

@endsection
@section('mis_scripts')
<script type="text/javascript">


        $(document).ready(function(){
            //group add limit
            var maxGroup = 10;

            //add more fields group
            $(".addMore").click(function(){
                if($('body').find('.fieldGroup').length < maxGroup){
                    var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
                    $('body').find('.fieldGroup:last').after(fieldHTML);
                }else{
                    alert('Maximum '+maxGroup+' groups are allowed.');
                }
            });

            //remove fields group
            $("body").on("click",".remove",function(){
                $(this).parents(".fieldGroup").remove();
            });
        });

        </script>
        <script type="text/javascript">

        $(document).ready(function(){
            //group add limit
            var maxGroup = 30;

            //add more fields group
            $(".addMore1").click(function(){
                if($('body').find('.fieldGroup1').length < maxGroup){
                    var fieldHTML = '<div class="form-group fieldGroup1">'+$(".fieldGroupCopy1").html()+'</div>';
                    $('body').find('.fieldGroup1:last').after(fieldHTML);
                }else{
                    alert('Maximum '+maxGroup+' groups are allowed.');
                }
            });

            //remove fields group
            $("body").on("click",".remove",function(){
                $(this).parents(".fieldGroup1").remove();
            });
        });

        </script>
        <script type="text/javascript">

        $(document).ready(function(){
            //group add limit
            var maxGroup = 30;

            //add more fields group
            $(".addMore2").click(function(){
                if($('body').find('.fieldGroup2').length < maxGroup){
                    var fieldHTML = '<div class="form-group fieldGroup2">'+$(".fieldGroupCopy").html()+'</div>';
                    $('body').find('.fieldGroup2:last').after(fieldHTML);
                }else{
                    alert('Maximum '+maxGroup+' groups are allowed.');
                }
            });

            //remove fields group
            $("body").on("click",".remove",function(){
                $(this).parents(".fieldGroup2").remove();
            });
        });

        </script>
        <script type="text/javascript">

        function Otorgado (valor) {
             var TotalSuma = 0;
            valor = parseInt(valor); // Convertir a numero entero (número).
            TotalSuma = document.getElementById('MiSaldo').innerHTML;
            // Valida y pone en cero "0".
            TotalSuma = (TotalSuma == null || TotalSuma == undefined || TotalSuma == "") ? 0 : TotalSuma;
            /* Variable genrando la suma. */
            TotalSuma = (parseInt(TotalSuma) + parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('MiSaldo').innerHTML = TotalSuma;
            document.getElementById('MiTotal').innerHTML = TotalSuma;




        }
        /* Funcion suma. */

        function SumarSubtotal1 (valor) {
            var TotalSuma = 0;
            valor = parseInt(valor); // Convertir a numero entero (número).
            TotalSuma = document.getElementById('SubTotal1').innerHTML;
            // Valida y pone en cero "0".
            TotalSuma = (TotalSuma == null || TotalSuma == undefined || TotalSuma == "") ? 0 : TotalSuma;
            /* Variable genrando la suma. */
            TotalSuma = (parseInt(TotalSuma) + parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('SubTotal1').innerHTML = TotalSuma;

            Total = document.getElementById('TotalS').innerHTML;
            // Valida y pone en cero "0".
            Total = (Total == null || Total == undefined || Total == "") ? 0 : Total;
            /* Variable genrando la suma. */
            Total = (parseInt(Total) + parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('TotalS').innerHTML = Total;

            MT = document.getElementById('MiTotal').innerHTML;
            /* Variable genrando la suma. */
            MT = (parseInt(MT) - parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('MiTotal').innerHTML = MT;



        }
        function SumarSubtotal2 (valor) {
            var SubTotal2 = 0;
            valor = parseInt(valor); // Convertir a numero entero (número).
            SubTotal2 = document.getElementById('SubTotal2').innerHTML;
            // Valida y pone en cero "0".
            SubTotal2 = (SubTotal2 == null || SubTotal2 == undefined || SubTotal2 == "") ? 0 : SubTotal2;
            /* Variable genrando la suma. */
            SubTotal2 = (parseInt(SubTotal2) + parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('SubTotal2').innerHTML = SubTotal2;

            Totala = document.getElementById('TotalS').innerHTML;
            // Valida y pone en cero "0".

            /* Variable genrando la suma. */
            Totala = (parseInt(Totala) + parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('TotalS').innerHTML = Totala;

            MT1 = document.getElementById('MiTotal').innerHTML;
            /* Variable genrando la suma. */
            MT1 = (parseInt(MT1) - parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('MiTotal').innerHTML = MT1;

        }
        function SumarSubtotal3 (valor) {
            var SubTotal3 = 0;
            valor = parseInt(valor); // Convertir a numero entero (número).
            SubTotal3 = document.getElementById('SubTotal3').innerHTML;
            // Valida y pone en cero "0".
            SubTotal3 = (SubTotal3 == null || SubTotal3 == undefined || SubTotal3 == "") ? 0 : SubTotal3;
            /* Variable genrando la suma. */
            SubTotal3 = (parseInt(SubTotal3) + parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('SubTotal3').innerHTML = SubTotal3;
            Totalb = document.getElementById('TotalS').innerHTML;
            // Valida y pone en cero "0".

            /* Variable genrando la suma. */
            Totalb = (parseInt(Totalb) + parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('TotalS').innerHTML = Totalb;

            MT2 = document.getElementById('MiTotal').innerHTML;
            /* Variable genrando la suma. */
            MT2 = (parseInt(MT2) - parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('MiTotal').innerHTML = MT2;

        }
        </script>
@endsection
