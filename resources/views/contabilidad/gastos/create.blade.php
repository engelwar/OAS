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
<table>
    <tr id="row" class="fila dis_none">
        <td>                                
            <input id="fecha[0]" type="date" min="{{$desde}}" max="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" class="form-control form-control-sm @error('fecha[0]') is-invalid @enderror" name="fecha[0]" required>
            @error('fecha[0]')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </td>
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
        <td>
            <input id="razon_s[0]" type="text" value="" class="form-control form-control-sm @error('razon_s') is-invalid @enderror" name="razon_s[0]">
            @error('razon_s')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </td>
        <td>
            <input id="detalle[0]" type="text" value="" class="form-control form-control-sm @error('detalle') is-invalid @enderror" name="detalle[0]">
            @error('detalle')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </td>
        <td>
            <input id="no_fac[0]" type="text" class="form-control form-control-sm @error('no_fac') is-invalid @enderror" name="no_fac[0]">
            @error('no_fac')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </td>
        <td>
            <input id="monto[0]" type="text" class="form-control form-control-sm @error('monto') is-invalid @enderror monto" name="monto[0]" required>
            @error('monto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </td>
    </tr>    
</table>
<div class="p-5 center">
                    <form method="POST" action="{{ route('rendiciongastos.store') }}">
                        @csrf

                        <div class=" row d-flex justify-content-center">
                            <div class="col-lg-3 col-sm-6">
                                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex align-items-center justify-content-center">
                                <h3 class="text-center text-primary">FORMULARIO DE RENDICION DE GASTOS</h3>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-end">                               
                            </div>
                        </div>

                        <div class="form-group row pt-5">
                            <label for="nombre" class="col-md-2 col-form-label">
                                {{ __('FUNCIONARIO') }}
                            </label>    
                            <div class="col-md-4">
                                <input id="nombre" type="text" value="{{Auth::user()->perfiles->nombre}} {{Auth::user()->perfiles->paterno}} {{Auth::user()->perfiles->materno}}" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="ci" class="col-md-1 col-form-label">
                                {{ __('CI') }}
                            </label>                    
                            <div class="col-md-2">
                                <input id="ci" type="ci" value="{{Auth::user()->perfiles->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
                                @error('ci')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="cargo" class="col-md-1 col-form-label">
                                {{ __('CARGO') }}
                            </label>                    
                            <div class="col-md-2">
                                <input id="cargo" type="cargo" value="{{Auth::user()->perfiles->cargo}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
                                @error('sucursal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="area" class="col-md-2 col-form-label">
                                {{ __('UNIDAD') }}
                            </label>
                                    
                            <div class="col-md-4">
                                <input id="area" type="text" value="{{Auth::user()->perfiles->unidad}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered" id="tabla" >
                                     <thead class="text-center">
                                        <th style="width:10%;" class="align-middle">Fecha</th>
                                        <th style="width:15%;" class="align-middle">Centro Costo</th>
                                        <th style="width:15%;" class="align-middle">Cuenta Contable</th>
                                        <th style="width:25%;" class="align-middle">Razon Social</th>
                                        <th class="align-middle">Concepto</th>
                                        <th class="align-middle">Nro. Factura</th>
                                        <th class="align-middle">Importe</th>
                                     </thead>
                                     <tbody id="tablab">
                                        <tr>
                                            <td>                                
                                                <input id="fecha[0]" type="date" min="{{$desde}}" max="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" class="form-control form-control-sm @error('fecha[0]') is-invalid @enderror" name="fecha[0]" required>
                                                @error('fecha[0]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
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
                                            <td>
                                                <input id="razon_s[0]" type="text" value="" class="form-control form-control-sm @error('razon_s') is-invalid @enderror" name="razon_s[0]">
                                                @error('razon_s')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input id="detalle[0]" type="text" value="" class="form-control form-control-sm @error('detalle') is-invalid @enderror" name="detalle[0]">
                                                @error('detalle')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input id="no_fac[0]" type="text" class="form-control form-control-sm @error('no_fac') is-invalid @enderror" name="no_fac[0]">
                                                @error('no_fac')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input id="monto[0]" type="text" class="form-control form-control-sm @error('monto') is-invalid @enderror monto" name="monto[0]" required>
                                                @error('monto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan = "5"></td> 
                                            <td class="text-right align-middle">TOTAL</td> 
                                            <td>
                                               <input id="total" type="text" class="form-control form-control-sm @error('total') is-invalid @enderror" name="total" readonly>
                                               @error('total')
                                                   <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                   </span>
                                               @enderror
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
                        <input type="hidden" id="cont" name="cont" value="{{$cont}}">
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
        cont = 0;
        $(".add-row").click(function()
        {      
            var row = document.getElementById("row");
            var table = document.getElementById("tablab");
            var clone = row.cloneNode(true);
            clone.classList.add('nueva');
            console.log($(clone).contents().find'(#fecha[0]'));
            table.appendChild(clone);
            $(".nueva").removeClass("dis_none nueva");
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
