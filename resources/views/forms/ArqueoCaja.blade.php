
@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')




<div class="fieldGroupCopy" style="display: none;">

                                                             <table class="table table-bordered table-sm" >



                                                <td class="align-middle"><input class="form-control" id="fecha" type="date" name="fecha[]" placeholder="MM/DD/AAAA" /></td>
                                                <td><input class="form-control" id="centro" type="text" name="centro[]" placeholder="Centro de costo" /></td>
                                                <td><input class="form-control" id="nrofactura" type="text" name="nrofactura[]" placeholder="No. Factura" /></td>
                                                <td><input class="form-control" id="nrorecibo" type="text" name="nrorecibo[]" placeholder="No. Recibo" /></td>
                                                <td><input class="form-control" id="razonsocial" type="text" name="proveedor[]" placeholder="Proveedor" /></td>
                                                <td><input class="form-control" id="importe" name="importe[]" type="text" placeholder="Importe"  onchange="RestarAutomatico(this.value);" /></td>
                                                <td><input class="form-control" id="detalle" type="text" name="detalle[]" placeholder="Detalle" /></td>

                                                <td><a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</a></td>



</table>




</div>


<form action="{{ route('arqueocaja.store') }}" method="POST">
    @csrf
 <div class="row justify-content-center">
 <div class="col-lg-12">
   <div class="card shadow-lg border-0 rounded-lg mt-5">
  <div class="card-header"><h2 class="text-center font-weight-light my-4"><B>FORMULARIO ADMINISTRATIVO DE CONTROL INTERNO</B></h2>
    <h2 class="text-center font-weight-light my-4"><B>ARQUEO DE CAJA</B></h2>

  </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="small mb-1" for="unidad">Unidad</label>
                                                  <input type="text" class="form-control @error('unidad') is-invalid @enderror" placeholder="Unidad" id="unidad" name="unidad">
                                                </div>
                                                <div class="col">
                                                    <label class="small mb-1" for="fech">Moneda</label>
                                                  <input type="text" class="form-control @error('moneda') is-invalid @enderror" placeholder="Moneda" id="moneda" name="moneda">
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col">
                                                    <label class="small mb-1" for="fech">Responsable</label>
                                                  <input type="text" class="form-control @error('responsable') is-invalid @enderror" placeholder="Responsable" id="responsable" name="responsable">
                                                </div>
                                                <div class="col">
                                                    <label class="small mb-1" for="fech">Fecha</label>
                                                  <input type="date" class="form-control @error('fecha') is-invalid @enderror" placeholder="Fecha" id="fecha" name="fecha">
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col">
                                                    <label class="small mb-1" for="fech">Caja</label>
                                                  <input type="text" class="form-control @error('caja') is-invalid @enderror" placeholder="Caja" id="caja" name="caja">
                                                </div>
                                                <div class="col">
                                                    <label class="small mb-1" for="fech">Hora</label>
                                                  <input type="time" class="form-control @error('hora') is-invalid @enderror" placeholder="Hora" id="hora" name="hora">
                                                </div>
                                              </div>


                                            <div class="form-group center">
                                                <div class="card-body">
                                                    <div class="form-group fieldGroup">



                                                             <table class="table table-bordered table-sm justify-content-center" >
                                                                  <thead>
                                                                     <tr>
                                                                        <th>Billetes</th>
                                                                        <th>Cantidades</th>
                                                                        <th>Importe</th>
                                                                        <th>total</th>

                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <tr>
                                                                        <td>Docientos Bolivianos</td>
                                                                        <td><input class="form-control" id="cantidad200" type="text" name="cantidad200" placeholder="Cantidades" onchange="Multiplicar200BB(this.value);" /></td>
                                                                        <td><input class="form-control" id="importe200" type="text" name="importe200" placeholder="Importe"/>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Cien Bolivianos</td>
                                                                        <td><input class="form-control" id="cantidad100" type="text" name="cantidad100" placeholder="Cantidades" onchange="Multiplicar100BB(this.value);" /></td>
                                                                        <td><input class="form-control" id="importe100" type="text" name="importe100" placeholder="Importe"/>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Cincuenta Bolivianos</td>
                                                                        <td><input class="form-control" id="cantidad50" type="text" name="cantidad50" placeholder="Cantidades" onchange="Multiplicar50BB(this.value);" /></td>
                                                                        <td><input class="form-control" id="importe50" type="text" name="importe50" placeholder="Importe"/>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Veinte Bolivianos</td>
                                                                        <td><input class="form-control" id="cantidad20" type="text" name="cantidad20" placeholder="Cantidades" onchange="Multiplicar20BB(this.value);" /></td>
                                                                        <td><input class="form-control" id="importe20" type="text" name="importe20" placeholder="Importe"/>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diez Bolivianos</td>
                                                                         <td><input class="form-control" id="cantidad10" type="text" name="cantidad10" placeholder="Cantidades" onchange="Multiplicar10BB(this.value);" /></td>
                                                                        <td><input class="form-control" id="importe10" type="text" name="importe10" placeholder="Importe"/>
                                                                        </td>

                                                                        <td><input class="form-control" id="BBtotal" type="text" name="BBtotal" value="0" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"><b>Monedas</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Cinco Bolivianos</td>
                                                                        <td><input class="form-control" id="C5MB" type="text" name="C5MB" placeholder="Cantidades" onchange="Multiplicar5MB(this.value);"/></td>
                                                                        <td><input class="form-control" id="I5MB" type="text" name="I5MB" placeholder="importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Dos Bolivianos</td>
                                                                        <td><input class="form-control" id="C2MB" type="text" name="C2MB" placeholder="Cantidades" onchange="Multiplicar2MB(this.value);"/></td>
                                                                        <td><input class="form-control" id="I2MB" type="text" name="I2MB" placeholder="importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Un Boliviano</td>
                                                                        <td><input class="form-control" id="C1MB" type="text" name="C1MB" placeholder="Cantidades" onchange="Multiplicar1MB(this.value);"/></td>
                                                                        <td><input class="form-control" id="I1MB" type="text" name="I1MB" placeholder="importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Cincuenta centavos de Boliviano</td>
                                                                        <td><input class="form-control" id="C05MB" type="text" name="C05MB" placeholder="Cantidades" onchange="Multiplicar05MB(this.value);"/></td>
                                                                        <td><input class="form-control" id="I05MB" type="text" name="I05MB" placeholder="importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Veinte centavos de Boliviano</td>
                                                                        <td><input class="form-control" id="C02MB" type="text" name="C02MB" placeholder="Cantidades" onchange="Multiplicar02MB(this.value);"/></td>
                                                                        <td><input class="form-control" id="I02MB" type="text" name="I02MB" placeholder="importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diez centavos de Boliviano</td>
                                                                        <td><input class="form-control" id="C01MB" type="text" name="C01MB" placeholder="Cantidades" onchange="Multiplicar01MB(this.value);"/></td>
                                                                        <td><input class="form-control" id="I01MB" type="text" name="I01MB" placeholder="importe" /></td>

                                                                        <td><input class="form-control" id="MBtotal" type="text" name="MBtotal" placeholder="Total" value="0" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"><b>Dolares Americanos</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CIEN DOLARES AMERICANOS</td>
                                                                        <td><input class="form-control" id="C100BDA" type="text" name="C100BDA" placeholder="Cantidades" onchange="Multiplicar100BDA(this.value);"/></td>
                                                                        <td><input class="form-control" id="I100BDA" type="text" name="I100BDA" placeholder="Importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>CINCUENTA DOLARES AMERICANOS</td>
                                                                        <td><input class="form-control" id="C50BDA" type="text" name="C50BDA" placeholder="Cantidades" onchange="Multiplicar50BDA(this.value);"/></td>
                                                                        <td><input class="form-control" id="I50BDA" type="text" name="I50BDA" placeholder="Importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>VEINTE DOLARES AMERICANOS</td>
                                                                        <td><input class="form-control" id="C20BDA" type="text" name="C20BDA" placeholder="Cantidades" onchange="Multiplicar20BDA(this.value);"/></td>
                                                                        <td><input class="form-control" id="I20BDA" type="text" name="I20BDA" placeholder="Importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>DIEZ DOLARES AMERICANOS</td>
                                                                        <td><input class="form-control" id="C10BDA" type="text" name="C10BDA" placeholder="Cantidades" onchange="Multiplicar10BDA(this.value);"/></td>
                                                                        <td><input class="form-control" id="I10BDA" type="text" name="I10BDA" placeholder="Importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>CINCO DOLARES AMERICANOS</td>
                                                                        <td><input class="form-control" id="C5BDA" type="text" name="C5BDA" placeholder="Cantidades" onchange="Multiplicar5BDA(this.value);"/></td>
                                                                        <td><input class="form-control" id="I5BDA" type="text" name="I5BDA" placeholder="Importe" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>SUB TOTAL DOLARES AMERICANOS</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="DAtotal" type="text" name="DAtotal" placeholder="DATotal" value="0" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>EQUIVALENTE A BOLIVIANOS</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="DABtotal" type="text" name="DABtotal" placeholder="Total" value="0" /></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td ><b>OTROS BILLETES, MONEDAS, ETC (DETALLES ADJUNTOS)</b></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="OBMtotal" type="text" name="OBMtotal" placeholder="Total"  value = "0" onclick ="TGB();"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"><b>CHEQUES EN CUSTODIA (DETALLES ADJUNTOS)</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CHEQUES </td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="ICC" type="text" name="ICC" placeholder="importe" onchange="SumarCC(this.value);"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CHEQUES A FECHA </td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="ICCF" type="text" name="ICCF" placeholder="importe" onchange="SumarCC(this.value);"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CHEQUES SIN FONDO</td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="ICSF" type="text" name="ICSF" placeholder="importe" onchange="SumarCC(this.value);"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>OTROS CHEQUES</td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="IOC" type="text" name="IOC" placeholder="importe" onchange="SumarCC(this.value);"/></td>
                                                                        <td><input class="form-control" id="CCtotal" type="text" name="CCtotal" placeholder="Total" value="0" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"><b>DOCUMENTOS DE CAJA (DETALLES ADJUNTOS)</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>VALES PROVISIONALES</td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="IDCC" type="text" name="IDCC" placeholder="importe" onchange="SumarDC(this.value);"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>FONDOS A RENDIR</td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="IDCC1" type="text" name="IDCC1" placeholder="importe" onchange="SumarDC(this.value);"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>RESERVAS</td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="IDCC2" type="text" name="IDCC2" placeholder="importe" onchange="SumarDC(this.value);"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>OTROS DOCUMENTOS</td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="IDCC3" type="text" name="IDCC3" placeholder="importe" onchange="SumarDC(this.value);"/></td>
                                                                        <td><input class="form-control" id="DCtotal" type="text" name="DCtotal" placeholder="Total" value="0" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>TOTAL GENERAL EN BOLIVIANOS</b></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><input class="form-control" id="TGB" type="text" name="TGB" placeholder="Total" /></td>
                                                                    </tr>




                                                                </tbody>
                                                            </table>

                                                    </div>




                            </div>
                                            </div>



                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" value="Solicitar Material" class="btn btn-primary btn-block" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                    var fieldHTML = '<div class="form-group fieldGroup1">'+$(".fieldGroupCopy").html()+'</div>';
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
        function equivalente() {
            var suma1 = 0;

            suma2 = document.getElementById('DAtotal').value;
            suma1 = parseFloat(suma2) * 6.9;
            document.getElementById('DABtotal').value = suma1;
        }
        /* Funcion suma. */
        function SumarAutomatico (valor) {
            var suma1 = 0;
            valu = parseInt(valor);
            suma2 = document.getElementById('BBtotal').value;
            suma1 = (parseInt(suma2) + parseInt(valu));
            document.getElementById('BBtotal').value = suma1;

        }
        function SumarBB (valor) {
            var suma1 = 0;
            valu = parseInt(valor);
            suma2 = document.getElementById('BBtotal').value;
            suma1 = (parseInt(suma2) + parseInt(valu));
            document.getElementById('BBtotal').value = suma1;
        }
        function SumarMB (valor) {
            var suma1 = 0;
            valu = parseFloat(valor);
            suma2 = document.getElementById('MBtotal').value;
            suma1 = (parseFloat(suma2) + parseFloat(valu)).toFixed(2);
            document.getElementById('MBtotal').value = suma1;
        }
        function SumarBDA (valor) {
            var suma1 = 0;
            valu = parseFloat(valor);
            suma2 = document.getElementById('DAtotal').value;
            suma1 = (parseFloat(suma2) + parseFloat(valu)).toFixed(2);
            document.getElementById('DAtotal').value = suma1;
        }
        function SumarCC (valor) {
            var suma1 = 0;
            valu = parseFloat(valor);
            suma2 = document.getElementById('CCtotal').value;
            suma1 = (parseFloat(suma2) + parseFloat(valu)).toFixed(2);
            document.getElementById('CCtotal').value = suma1;
            TGB();
        }
        function SumarDC (valor) {
            var suma1 = 0;
            valu = parseFloat(valor);
            suma2 = document.getElementById('DCtotal').value;
            suma1 = (parseFloat(suma2) + parseFloat(valu)).toFixed(2);
            document.getElementById('DCtotal').value = suma1;
            TGB();
        }
        </script>
        <script type="text/javascript">
        /* Funcion resta. */
        function RestarAutomatico (valor) {
            var TotalSuma = 0;
            valor = parseInt(valor); // Convertir a numero entero (número).
            TotalResta = document.getElementById('MiTotal').innerHTML;
            // Valida y pone en cero "0".
            TotalResta = (TotalResta == null || TotalResta == undefined || TotalResta == "") ? 0 : TotalResta;
            /* Variable genrando la suma. */
            TotalResta = (parseInt(TotalResta) - parseInt(valor));
            // Escribir el resultado en una etiqueta "span".
            document.getElementById('MiTotal').innerHTML = TotalResta;
        }
        function Multiplicar200BB (valor) {

            var text=0;
            texto = document.getElementById("cantidad200").value;
            texto = texto * 200;
            document.getElementById("importe200").value = texto;
            SumarBB(texto);
            TGB();
        }
        function Multiplicar100BB (valor) {

            var text=0;
            texto = document.getElementById("cantidad100").value;
            texto = texto * 100;
            document.getElementById("importe100").value = texto;
            SumarBB(texto);
            TGB();
        }
        function Multiplicar50BB (valor) {

            var text=0;
            texto = document.getElementById("cantidad50").value;
            texto = texto * 50;
            document.getElementById("importe50").value = texto;
            SumarBB(texto);
            TGB();
        }
        function Multiplicar20BB (valor) {

            var text=0;
            texto = document.getElementById("cantidad20").value;
            texto = texto * 20;
            document.getElementById("importe20").value = texto;
            SumarBB(texto);
            TGB();
        }
        function Multiplicar10BB (valor) {

            var text=0;
            texto = document.getElementById("cantidad10").value;
            texto = texto * 10;
            document.getElementById("importe10").value = texto;
            SumarBB(texto);
            TGB();
        }
        function Multiplicar200BB (valor) {

            var text=0;
            texto = document.getElementById("cantidad200").value;
            texto = texto * 200;
            document.getElementById("importe200").value = texto;
            SumarBB(texto);
            TGB();
        }
        function Multiplicar5MB (valor) {

            var text=0;
            texto = document.getElementById("C5MB").value;
            texto = texto * 5;
            document.getElementById("I5MB").value = texto;
            SumarMB(texto);
            TGB();
        }
        function Multiplicar2MB (valor) {

            var text=0;
            texto = document.getElementById("C2MB").value;
            texto = texto * 2;
            document.getElementById("I2MB").value = texto;
            SumarMB(texto);
            TGB();
        }
        function Multiplicar1MB (valor) {

            var text=0;
            texto = document.getElementById("C1MB").value;
            texto = texto * 1;
            document.getElementById("I1MB").value = texto;
            SumarMB(texto);
            TGB();
        }
        function Multiplicar05MB (valor) {

            var text=0;
            texto = document.getElementById("C05MB").value;
            texto = texto * 0.5;
            texto=texto.toFixed(2);
            document.getElementById("I05MB").value = texto;
            SumarMB(texto);
            TGB();
        }
        function Multiplicar02MB (valor) {

            var text=0;
            texto = document.getElementById("C02MB").value;
            texto = texto * 0.2;
            texto=texto.toFixed(2);
            document.getElementById("I02MB").value = texto;
            SumarMB(texto);
            TGB();
        }
        function Multiplicar01MB (valor) {

            var text=0;
            texto = document.getElementById("C01MB").value;
            texto = texto * 0.1;
            texto=texto.toFixed(2);
            document.getElementById("I01MB").value = texto;
            SumarMB(texto);
            TGB();
        }

        function TGB() {

            var var1,var2,texto=0;
            var var3=0;

            var1 = document.getElementById('BBtotal').value;
            var2 = document.getElementById('MBtotal').value;
            var3 = document.getElementById('DABtotal').value;
            var4 = document.getElementById('CCtotal').value;
            var5 = document.getElementById('DCtotal').value;
            var6 = document.getElementById('OBMtotal').value;
            texto = parseFloat(var1) + parseFloat(var2)+  parseFloat(var3)+  parseFloat(var4) +  parseFloat(var5) +  parseFloat(var6);
            document.getElementById("TGB").value = texto;

        }

        function Multiplicar100BDA (valor) {

            var text=0;
            texto = document.getElementById("C100BDA").value;
            texto = texto *100;
            texto=texto.toFixed(2);
            document.getElementById("I100BDA").value = texto;
            SumarBDA(texto);

            equivalente();
            TGB();
        }

        function Multiplicar50BDA (valor) {

            var text=0;
            texto = document.getElementById("C50BDA").value;
            texto = texto *50;
            texto=texto.toFixed(2);
            document.getElementById("I50BDA").value = texto;
            SumarBDA(texto);

            equivalente();
            TGB();
        }
        function Multiplicar20BDA (valor) {

            var text=0;
            texto = document.getElementById("C20BDA").value;
            texto = texto *20;
            texto=texto.toFixed(2);
            document.getElementById("I20BDA").value = texto;
            SumarBDA(texto);

            equivalente();
            TGB();
        }
        function Multiplicar10BDA (valor) {

            var text=0;
            texto = document.getElementById("C10BDA").value;
            texto = texto *10;
            texto=texto.toFixed(2);
            document.getElementById("I10BDA").value = texto;
            SumarBDA(texto);

            equivalente();
            TGB();
        }
        function Multiplicar5BDA (valor) {

            var text=0;
            texto = document.getElementById("C5BDA").value;
            texto = texto *5;
            texto=texto.toFixed(2);
            document.getElementById("I5BDA").value = texto;
            SumarBDA(texto);

            equivalente();
             TGB();
        }
        </script>
@endsection
