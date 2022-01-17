@extends('layouts.app')

@section('mi_estilo')
 <style>
    @media (min-width: 600px) 
    {
        .container_pad 
        {
            padding:100px;
        }
    }
    .dis_none
    {
        display: none;
    }
 </style>
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        Errores:
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
<table>
    <tr id="row" class="fila dis_none">
        <td>
            <select id="centro_c[]" type="text" class="form-control  form-control-sm" name="centro_c[]" required>
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
            <select id="cuenta_c[]" type="text" class="form-control  form-control-sm" name="cuenta_c[]" required>
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
        <td>
            <input id="detalle[]" type="text" class="form-control form-control-sm " name="detalle[]" required autocomplete="off">
        </td>
        <td>
            <input id="motivo[]" type="text" class="form-control form-control-sm" name="motivo[]" required autocomplete="off">
        </td>
        <td>
            <input id="monto[]" type="text" class="form-control form-control-sm monto" name="monto[]" required autocomplete="off">
        </td>
    </tr>    
</table>
<div class="p-5 center">
    <form method="POST" action="{{ route('solicitudgastos.store') }}">
        @csrf

        <div class=" row d-flex justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
            </div>
            <div class="col-lg-6 col-sm-12 d-flex align-items-center justify-content-center">
                <h3 class="text-center text-primary">SOLICITUD DE GASTOS</h3>
            </div>
            <div class="col-lg-3 d-flex align-items-center justify-content-end">                               
            </div>
        </div>

        <div class="form-group row pt-5">
            <div class="col-4">
                <H5>
                    <b>Funcionario: </b>{{Auth::user()->perfiles->nombre .' '. Auth::user()->perfiles->paterno .' '. Auth::user()->perfiles->materno}}
                </H5>     
                <H5>
                    <b>CI: </b>{{Auth::user()->perfiles->ci .' '. Auth::user()->perfiles->ci_e}}
                </h5>
            </div>    
            <div class="col-3">
                <H5>
                    <b>Cargo: </b>{{Auth::user()->perfiles->cargo}}
                </H5>   
                <H5>
                    <b>Unidad: </b>{{Auth::user()->perfiles->unidad}}
                </H5>
            </div>          
        </div>
        <div class="row d-flex justify-content-center mt-3">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" id="tabla" >
                        <thead class="text-center">
                        <th style="width:12%;" class="align-middle">Centro Costo</th>
                        <th style="width:12%;" class="align-middle">Tipo de Gasto</th>
                        <th style="width:25%;" class="align-middle">Gato Solicitado</th>
                        <th style="width:25%" class="align-middle">Motivo</th>
                        <th class="align-middle" style="width:10%">Importe Estimado</th>

                        </thead>
                        <tbody id="tablab">
                        <tr>                              
                            <td>
                                <select id="centro_c[]" type="text" class="form-control  form-control-sm" name="centro_c[]" required>
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
                                <select id="cuenta_c[]" type="text" class="form-control  form-control-sm" name="cuenta_c[]" required>
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
                            <td>
                                <input id="detalle[]" type="text" class="form-control form-control-sm" name="detalle[]" required autocomplete="off">
                            </td>
                            <td>
                                <input id="motivo[]" type="text" class="form-control form-control-sm" name="motivo[]" required autocomplete="off">
                            </td>
                            <td>
                                <input id="monto[]" type="text" class="form-control form-control-sm monto" name="monto[]" required autocomplete="off">
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan = "3"></td> 
                            <td class="text-right align-middle">TOTAL</td> 
                            <td>
                                <input id="total" type="text" class="form-control form-control-sm @error('total') is-invalid @enderror" name="total" readonly>
                            </td> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
            </div>
        </div>

        <div class="row mb-3">
            <div class="col d-flex justify-content-end ">
                <!--a class="delete-row btn btn-danger btn-xs text-light mr-2">-</a-->
                <a class="first add-row btn btn-primary btn-xs text-light">Añadir</a>
            </div>
        </div>  
        @if(isset($cont))
            <input type="hidden" id="cont" name="cont" value="$cont">
        @else
            <input type="hidden" id="cont" name="cont" value="1">
        @endif
        <div class="form-group row d-flex justify-content-center">
            <div class="col-md-10 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">
                    {{ __('Enviar') }}
                </button>
            </div>
        </div>                        
    </form>
</div>
@endsection
@section('mis_scripts')
<script>
    $(document).ready(function(){
        cont = 1;    
        $(".add-row").click(function()
        {      
            var row = document.getElementById("row");
            var table = document.getElementById("tablab");
            var clone = row.cloneNode(true);
            clone.classList.add('nueva');
            //console.log($(clone).contents().find'(#fecha[]'));
            table.appendChild(clone);
            $(".nueva").removeClass("dis_none nueva");
            cont +=1;
            document.getElementById('cont').value = cont;
        });        
        // Find and remove selected table rows
        $(".delete-row").click(function()
        {
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
        
        function sumamodal() {
        // Para suma de montos
        var total = 0;
            $(".monto").each(function () {
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

        $(document).on('keyup','.monto',function(){
        sumamodal();
        });
        
    }); 
</script>

@endsection
