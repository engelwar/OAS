@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
<div class="p-5 center">
                    <form method="POST" action="{{ route('rendiciongastostransporte.store') }}">
                        @csrf
                        <div class=" row d-flex justify-content-center">
                            <div class="col-3 px-5">
                                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <h3 class="text-center text-primary">FORMULARIO DE RENDICION</br> GASTOS DE MOVILIZACION</h3>
                            </div>
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <h4 style="color:red">Nro. </h4>                                
                            </div>
                        </div>
                        <div class="form-group row pt-4">
                            <label for="nombre" class="col-md-1 col-form-label">
                                {{ __('FUNCIONARIO') }}
                            </label>    
                            <div class="col-md-3">
                                <input id="nombre" type="text" value="{{Auth::user()->perfiles->nombre}} {{Auth::user()->paterno}} {{Auth::user()->materno}}" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="ci" class="col-md-1 col-form-label ">
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

                            
                        </div>
        
                        <div class="form-group row">
                            <label for="area" class="col-md-1 col-form-label">
                                {{ __('UNIDAD') }}
                            </label>
                                    
                            <div class="col-md-3">
                                <input id="area" type="text" value="{{Auth::user()->perfiles->area}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
                                @error('area')
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

                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered" id="tabla" >
                                     <thead class="text-center">
                                        <th style="width: 90px" class="align-middle">Fecha</th>
                                        <th style="width: 80px" class="align-middle">Hora Inicio</th>
                                        <th style="width: 80px" class="align-middle">Hora Fin</th>
                                        <th style="width: 90px" class="align-middle">Centro de Costo</th>
                                        <th style="width: 250px" class="align-middle">Motivo de Visita</th>
                                        <th style="width: 50px" class="align-middle">Importe en Bs.</th>
                                     </thead>
                                     <tbody>
                                         @for($i = 1; $i <= $cont; $i++)
                                        <tr>
                                        <td >
                                            <input id="fecha{{$i}}" type="date" value="{{date('Y-m-d')}}" class="form-control form-control-sm @error('fecha') is-invalid @enderror" name="fecha{{$i}}" required>
                                            @error('fecha')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="hora_ini{{$i}}" type="time" value="" class="form-control form-control-sm  @error('hora_ini') is-invalid @enderror" name="hora_ini{{$i}}" required>
                                            @error('hora_ini')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="hora_fin{{$i}}" type="time" value="" class="form-control form-control-sm  @error('hora_fin') is-invalid @enderror" name="hora_fin{{$i}}" required>
                                            @error('hora_fin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select id="centro_c{{$i}}" type="text" class="form-control  form-control-sm" name="centro_c{{$i}}">
                                                <option disabled selected value="nada">Seleccione Centro de Costo</option>
                                                <option value="Casa Matriz">Casa Matriz</option>
                                                <option value="Mariscal">Mariscal</option>
                                                <option value="Handal">Handal</option>
                                                <option value="Calacoto">Calacoto</option>
                                                <option value="Administracion">Administracion</option>
                                            </select>
                                        </td>
                                        <!--td>
                                            <input id="razon_s{{$i}}" type="text" value="" class="form-control form-control-sm  @error('razon_s') is-invalid @enderror" name="razon_s{{$i}}">
                                            @error('razon_s')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td-->
                                        <td>
                                            <input id="motivo{{$i}}" type="text" class="form-control  form-control-sm  @error('motivo') is-invalid @enderror" name="motivo{{$i}}">
                                            @error('motivo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="monto{{$i}}" type="text" class="form-control form-control-sm  @error('monto') is-invalid @enderror monto" name="monto{{$i}}">
                                            @error('monto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                      </tr>
                                      @endfor
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan ="4"></td> 
                                            <td class="text-right align-middle">Sub. Total</td> 
                                            <td colspan="1">
                                               <input id="total" type="text" class="form-control form-control-sm  @error('total') is-invalid @enderror" name="total" readonly>
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
        var cont = "{{$cont}}";
        $(".add-row").click(function()
        {
            cont = parseInt(cont) +1;
            
            var markup = '<tr>'+
            '<td><input id="fecha'+cont+'" type="date" value="{{date("Y-m-d")}}" class="form-control form-control-sm @error("fecha'+cont+'") is-invalid @enderror name="fecha'+cont+'" required></td>'+
            '<td><input id="hora_ini'+cont+'" type="time" value="" class="form-control form-control-sm @error("hora_ini'+cont+'") is-invalid @enderror" name="hora_ini'+cont+'" required></td>'+
            '<td><input id="hora_fin'+cont+'" type="time" value="" class="form-control form-control-sm @error("hora_fin'+cont+'") is-invalid @enderror" name="hora_fin'+cont+'" required></td>'+
            '<td><select id="centro_c{{$i}}" type="text" class="form-control  form-control-sm" name="centro_c{{$i}}">'+
                '<option disabled selected value="nada">Seleccione Centro de Costo</option>'+
                '<option value="Casa Matriz">Casa Matriz</option>'+
                '<option value="Mariscal">Mariscal</option>'+
                '<option value="Handal">Handal</option>'+
                '<option value="Calacoto">Calacoto</option>'+
                '<option value="Administracion">Administracion</option>'+
                '<option></option>'+
            '</select></td>'+
            '<td><input id="motivo'+cont+'" type="text" class="form-control form-control-sm @error("motivo'+cont+'") is-invalid @enderror" name="motivo'+cont+'"></td>'+
            '<td><input id="monto'+cont+'" type="text" class="form-control form-control-sm @error("monto'+cont+'") is-invalid @enderror monto" name="monto'+cont+'"</td>'+
            '</tr>';
            $("table#tabla tbody").append(markup);
            $(" #cont").val(cont);
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
