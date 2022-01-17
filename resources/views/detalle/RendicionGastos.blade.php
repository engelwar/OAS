@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
<div class="container my-5 center border" style="padding:100px;">
                    <form method="POST" action="{{ route('rendiciongastos.store') }}">
                        @csrf

                        <div class=" row d-flex justify-content-center">
                            <div class="col-3">
                                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <h3 class="text-center text-primary">FORMULARIO DE RENDICION DE GASTOS</h3>
                            </div>
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <h4 style="color:red">Nro. </h4>                                
                            </div>
                        </div>

                        <div class="form-group row pt-5">
                            <label for="nombre" class="col-md-2 col-form-label text-md-right">
                                {{ __('FUNCIONARIO') }}
                            </label>    
                            <div class="col-md-4">
                                <input id="nombre" type="text" value="{{Auth::user()->nombre}} {{Auth::user()->paterno}} {{Auth::user()->materno}}" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="ci" class="col-md-1 col-form-label text-md-right">
                                {{ __('CI') }}
                            </label>                    
                            <div class="col-md-2">
                                <input id="ci" type="ci" value="{{Auth::user()->ci}}" class="form-control @error('ci') is-invalid @enderror" name="ci">
                                @error('ci')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="cargo" class="col-md-1 col-form-label text-md-right">
                                {{ __('CARGO') }}
                            </label>                    
                            <div class="col-md-2">
                                <input id="cargo" type="cargo" value="{{Auth::user()->cargo}}" class="form-control @error('cargo') is-invalid @enderror" name="cargo">
                                @error('sucursal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="area" class="col-md-2 col-form-label text-md-right">
                                {{ __('UNIDAD') }}
                            </label>
                                    
                            <div class="col-md-4">
                                <input id="area" type="text" value="{{Auth::user()->area}}" class="form-control @error('area') is-invalid @enderror" name="unidad_trabajo" value="{{ old('area') }}" required autocomplete=area">
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover table-primary" id="tabla" >
                                     <thead class="text-center">
                                        <th style="width:10%;" class="align-middle">FECHA</th>
                                        <th style="width:15%;" class="align-middle">CENTRO COSTO</th>
                                        <th style="width:25%;" class="align-middle">RAZON SOCIAL</th>
                                        <th class="align-middle">CONCEPTO</th>
                                        <th class="align-middle">NRO. FACTURA</th>
                                        <th class="align-middle">IMPORTE EN Bs.</th>
                                     </thead>
                                     <tbody>
                                         @foreach($gastos as $g)
                                        <tr>
                                        <td >
                                            <input id="fecha{{$g}}" type="date" value="{{$g->fecha}}" class="form-control @error('fecha') is-invalid @enderror" name="fecha{{$g}}" required>
                                            @error('fecha')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="centro_c{{$g}}" type="text" value="{{$g->centro_c}}" class="form-control @error('centro_c') is-invalid @enderror" name="centro_c{{$g}}">
                                            @error('centro_c')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="razon_s{{$g}}" type="text" value="{{$g->razon_s}}" class="form-control @error('razon_s') is-invalid @enderror" name="razon_s{{$g}}">
                                            @error('razon_s')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="detalle{{$g}}" type="text" value="{{$g->detalle}}" class="form-control @error('detalle') is-invalid @enderror" name="detalle{{$g}}">
                                            @error('detalle')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="no_fac{{$g}}" type="text" value="{{$g->no_fac}}" class="form-control @error('no_fac') is-invalid @enderror" name="no_fac{{$g}}">
                                            @error('no_fac')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="monto{{$g}}" type="text" value="{{$g->monto}}" class="form-control @error('monto') is-invalid @enderror monto" name="monto{{$g}}">
                                            @error('monto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td> 
                                            <td></td> 
                                            <td></td> 
                                            <td></td> 
                                            <td class="text-right align-middle">TOTAL</td> 
                                            <td>
                                               <input id="total" type="text" value="{{$form->total}}" class="form-control @error('total') is-invalid @enderror" name="total" readonly>
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
 

                        
                    </form>
</div>

@endsection
@section('mis_scripts')
<script>

    $(document).ready(function(){
        $(".add-row").click(function()
        {
            cont = parseInt(cont) +1;
            
            var markup = '<tr>'+
            '<td><input id="fecha'+cont+'" type="date" value="{{date("Y-m-d")}}" class="form-control @error("fecha'+cont+'") is-invalid @enderror name="fecha'+cont+'" required></td>'+
            '<td><input id="centro_c'+cont+'" type="text" class="form-control @error("centro_c'+cont+'") is-invalid @enderror" name="centro_c'+cont+'"></td>'+
            '<td><input id="razon_s'+cont+'" type="text" class="form-control @error("razon_s'+cont+'") is-invalid @enderror" name="razon_s'+cont+'"></td>'+
            '<td><input id="detalle'+cont+'" type="text" class="form-control @error("detalle'+cont+'") is-invalid @enderror" name="detalle'+cont+'"></td>'+
            '<td><input id="no_fac'+cont+'" type="text" class="form-control @error("no_fac'+cont+'") is-invalid @enderror" name="no_fac'+cont+'"></td>'+
            '<td><input id="monto'+cont+'" type="text" class="form-control @error("monto'+cont+'") is-invalid @enderror monto" name="monto'+cont+'"</td>'+
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
