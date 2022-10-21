<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            font-size:0.8rem;
        }
        .raya {
border-bottom: 1px solid #000000;
}
    </style>
</head>
<body>
    <h5>La Paz {{$fechaH}}</h5>       
    <h5>LYPO/ADM//COB/[001-2022]</h5>

    <H3 class="mt-5">Señores</H3>
    <H3>NUEVA TEL....</H3>
    <H3>Presente.-</H3>
    <H3 style="text-align: right"><strong> Ref.: <span class="raya">CONFIRMACION DE SALDO CLIENTES</strong> </span> </H3>

    <H3 class="mt-5">Distinguidos señores:</H3>
    <br>
    <p style="padding-top: 20px;text-indent: 25px;font-size: 15px"> Como resultado de la Auditoria Interna realizada al {{$fechaC}}, nuestros libros contables regisdtran un saldo por cobrar de $us.[monto zxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx)
        ,su equivalente al tipo de cambio actual de BS. [dsadsadsadsadsadsadsdsadsa]detallado de la siguiente manera:
        ] </p>   
  
  
  <h4 style="text-align: center; padding-top: 20px;"> <strong>ESTADO DE CUENTA CLIENTE</strong></h4>
  <h4 style="text-align: center;"> <strong>Al: {{$fechaC}}</strong></h4>
    <table class = "table table-bordered table-sm">
        <thead class="thead-light">
            <tr>
                <td colspan="3" style="text-align: center;background: #d8d8e4;">FECHA</td>
                <td style="background: #c8c8ea;"></td>
                <td colspan="3" style="text-align: center;background: #c8c8ea;">IMPORTE EN DOLARES</td>
                <td colspan="3" style="text-align: center;background: #d8d8e4;">IMPORTE EN BOLIVIANOS</td>
            </tr>
            <tr>
           
            <td style="text-align: center;background: #d8d8e4;">FACTURADO</td>
            <TD style="text-align: center;background: #d8d8e4;">NRO. FACTURA</TD>
            <td style="text-align: center;background: #d8d8e4;">VENCIMIENTO</td>
            <td style="text-align: center;background: #c8c8ea;">ESTADO</td>
            <td style="text-align: center;background: #c8c8ea;">IMPORTE</td>
            <td style="text-align: center;background: #c8c8ea;">A CUENTA</td>
            <td style="text-align: center;background: #c8c8ea;">SALDO</td>
            <td style="text-align: center;background: #d8d8e4;">IMPORTE</td>
            <td style="text-align: center;background: #d8d8e4;">A CUENTA</td>
            <td style="text-align: center;background: #d8d8e4;">SALDO</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: center;border: none;" colspan="3"></td>
                
                <td style="text-align: center" >TOTALES</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
                <td style="text-align: center" >0</td>
            </tr>
        </tfoot>
        
    </table>
   <p style="padding-top: 20px;text-indent: 25px;font-size: 15px">Agradecemos comunicar cualquier observación, adjuntando el debido respaldo, caso contrario daremos por confimado el saldo mencionado.</p>
   
   <p style="padding-top: 20px;text-indent: 25px;font-size: 15px">Por lo tanto, corresponde de su parte la debida atención a nuestro requerimiento. Sin otro particular, enviamos un cordial saludo.</p>
   
   
</body>
</html>

