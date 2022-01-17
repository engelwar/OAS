<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .page-number:before {
            content: "Pagina " counter(page);
        }
        table, th, td {
            font-size: 0.7rem;
        }
        body {
            font-family: 'FuturaLuz';
        }
        @font-face {
            font-family: 'Arial';
            font-weight: normal;
        }
        .titulo{
            width:50%;
            font-size:0.9rem; 
            height:100%;
            text-align:center;    
        }
        h5{
            font-weight:bold;

        }
        div.page
        {
            page-break-after: always;   
        } 
        footer {
            clear: both;
            position: absolute;
        }
        .firma-line{
            width:95%; 
            border-top:solid 1px;
            margin-left: auto;
            margin-right: auto; 
            margin-bottom: 5px
        } 
        </style>
</head>
<!--div id="footer">
  <div class="page-number"></div>
</div-->
<body>
@if(count($data))
    @foreach($data as $d) 
        @if($d)
            @foreach($d->prods->groupBy('hoja') as $h => $prods)
                <div class="page">
                    <div style="height:725px">
                        <div style="display: grid;display: -webkit-box;font-size:0.9rem;">
                            <div style="width:25%;">
                                <img alt="foto" src="{{asset('imagenes/logo.png')}}" width="200px"/> 
                            </div>
                            <div class="text-center titulo">
                                <div>
                                    <h5>FORMULARIO ADMINISTRATIVO - CONTABILIDAD</h5>
                                    <h5>TOMA DE INVENTARIO FISICO</h5>
                                    <h5>Sucursal: {{$d->toma->sucs->nombre}}</h5>
                                    
                                </div>
                            </div>
                            <div class="text-end" style="width:25%;">
                                <h5>Conteo Nro. {{$d->conteo_id}}</h5>
                            </div>
                        </div>
                        <table style="width:100%;" class="table table-sm table-bordered text-center mt-4 border-dark">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th>NRO</th>
                                    <th>MARCA</th>
                                    <th>CODIGO</th>
                                    <th>DESCRIPCION</th>
                                    <th>U.M.</th>
                                    <th>COD. BARRAS</th>
                                    <th>CANTIDAD</th>
                                </tr>
                                @foreach($prods as $n => $p)
                                <tr>
                                    <td>{{$n+1}}</td>
                                    <td>{{$p->marca}}</td>
                                    <td>{{$p->prod}}</td>
                                    <td>{{$p->descrip}}</td>
                                    <td>{{$p->um}}</td>
                                    <td>{{$p->barcod}}</td>
                                    <td>{{$p->cantidad}}</td>
                                </tr>
                                @endforeach
                                @for ($i = count($prods)+1; $i <= 18; $i++)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> 
                                @endfor
                            </thead>
                        </table>  
                    </div>
                    <footer class="w-100">
                        <div style="height:150px;width:100%;padding:15px;">
                            <div style="height:100px;display: grid;display: -webkit-box;">
                                <div style="width:25%;">
                                    <div class="firma-line"></div>
                                    <div style="line-height: normal;width:90%;margin-left: auto;margin-right: auto; ">  
                                        <h6 class="text-center fw-bold">FIRMA RESPONSABLE DE UNIDAD</h6> 
                                        <div style="width:100%;display: -webkit-box; font-size: 0.7rem;">
                                            <div style="width:30%;" class="fw-bold">NOMBRE:
                                            </div>
                                            <div style="width:70%;text-transform: uppercase;">
                                            </div>
                                        </div>  
                                        <div style="width:100%;display: -webkit-box; font-size: 0.7rem;">
                                            <div style="width:30%;" class="fw-bold">CARGO:
                                            </div>
                                            <div style="width:70%;">
                                            </div>
                                        </div>                     
                                    </div>
                                </div>
                                <div style="width:25%;">
                                    <div class="firma-line"></div>
                                    <div style="line-height: normal;width:90%;margin-left: auto;margin-right: auto; ">  
                                        <h6 class="text-center fw-bold">FIRMA RESP. DE LA TOMA DE INV.</h6> 
                                        <div style="width:100%;display: -webkit-box; font-size: 0.7rem;">
                                            <div style="width:30%;" class="fw-bold">NOMBRE:
                                            </div>
                                            <div style="width:70%;text-transform: uppercase;">
                                                
                                            </div>
                                        </div>  
                                        <div style="width:100%;display: -webkit-box; font-size: 0.7rem;">
                                            <div style="width:30%;" class="fw-bold">CARGO:
                                            </div>
                                            <div style="width:70%;">
                                               
                                            </div>
                                        </div>                     
                                    </div>
                                </div>
                                <div style="width:25%;">
                                    <div class="firma-line"></div>
                                    <div style="line-height: normal;width:90%;margin-left: auto;margin-right: auto; ">  
                                        <h6 class="text-center fw-bold">FIRMA DE CONTABILIDAD</h6> 
                                        <div style="width:100%;display: -webkit-box; font-size: 0.7rem;">
                                            <div style="width:30%;" class="fw-bold">NOMBRE:
                                            </div>
                                            <div style="width:70%;text-transform: uppercase;">
                                                
                                            </div>
                                        </div>  
                                        <div style="width:100%;display: -webkit-box; font-size: 0.7rem;">
                                            <div style="width:30%;" class="fw-bold">CARGO:
                                            </div>
                                            <div style="width:70%;">
                                                
                                            </div>
                                        </div>                     
                                    </div>
                                </div>
                                
                                <div style="width:25%;">
                                    <div class="firma-line"></div>
                                    <div style="line-height: normal;width:90%;margin-left: auto;margin-right: auto; ">  
                                        <h6 class="text-center fw-bold">FIRMA DE Vo.Bo.</h6> 
                                        <div style="width:100%;display: -webkit-box; font-size: 0.7rem;">
                                            <div style="width:30%;" class="fw-bold">NOMBRE:
                                            </div>
                                            <div style="width:70%;text-transform: uppercase;">
                                                ERNESTO WEINBERG
                                            </div>
                                        </div>  
                                        <div style="width:100%;display: -webkit-box; font-size: 0.7rem;">
                                            <div style="width:30%;" class="fw-bold">CARGO:
                                            </div>
                                            <div style="width:70%;">
                                                GERENTE DE ADMINISTRACIÓN Y LOG.
                                            </div>
                                        </div>                     
                                    </div>
                                </div>
                            </div>  
                            <div class="text-end w-100">{{$h}} de {{$d->prods->groupBy('hoja')->last()->first()->hoja}}</div>
                        </div>                        
                    </footer>  
                </div>                            
            @endforeach
        @endif 
    @endforeach
@endif    
</body>
</html>

