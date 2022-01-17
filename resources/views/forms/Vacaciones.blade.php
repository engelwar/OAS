@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
<div class="container my-5 center border" style="padding:100px;" >
    <form method="POST" action="{{ route('vacacion.store') }}">
        @csrf
        <div class=" row d-flex justify-content-center">
            <div class="col-3">
                <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center">
                <h3 class="text-center text-primary">FORMULARIO VACACIONES</h3>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-end">
                <h4 style="color:red">Nro. </h4>                                
            </div>
        </div>

        <div class="form-group row pt-5">
            <label for="nombre" class="col-md-2 col-form-label">
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

            <label for="ci" class="col-md-1 col-form-label">
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
            <label for="area" class="col-md-2 col-form-label">
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

        <div class="form-group row">
            <label for="fecha_ini" class="col-md-2 col-form-label">
                {{ __('FECHA DE SALIDA') }}
            </label>
                    
            <div class="col-md-3">
                <input id="fecha_ini" type="date" class="form-control form-control @error('fecha_ini') is-invalid @enderror" name="fecha_ini" value="{{ old('fecha_ini') }}" required autocomplete="fecha_ini">
                @error('fecha_ini')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="fecha_fin" class="col-md-3 ml-auto col-form-label">
                {{ __('FECHA FINALIZACION') }}
            </label>
                    
            <div class="col-md-3 ">
                <input id="fecha_fin" type="date" class="form-control form-control @error('fecha_ifin') is-invalid @enderror" name="fecha_fin" value="{{ old('fecha_fin') }}" required autocomplete="fecha_fin">
                @error('fecha_fin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
                       
        <div class="form-group row">
            <label for="fecha_ret" class="col-md-2 col-form-label">
                {{ __('FECHA RETORNO') }}
            </label>
                    
            <div class="col-md-3">
                <input id="fecha_ret" type="date" class="form-control @error('fecha_ret') is-invalid @enderror" name="fecha_ret" value="{{ old('fecha_ret') }}" required autocomplete="fecha_ret">
                @error('fecha_ini')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>     

        <div class="form-group row d-flex">
            <label for="dias_v" class="col-md-2 col-form-label text-md-right ml-auto">
                {{ __('DIAS DE VACACION') }}
            </label>
                    
            <div class="col-md-1">
                <input id="dias_v" type="text" class="form-control @error('dias_v') is-invalid @enderror" name="dias_v" value="{{auth()->user()->dias_vacacion}}" required autocomplete="dias_v" readonly>
                    @error('dias_v')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
                   
            <div class="col-md-4">
                <input id="dias_v_l" type="text" placeholder="Literal" class="form-control @error('dias_v') is-invalid @enderror" name="dias_v_l" value="{{$dias}}" required autocomplete="dias_v_l" readonly>
                    @error('dias_v_l')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div>
        
        <div class="form-group row d-flex">
        <label for="dias" class="col-md-2 col-form-label text-md-right ml-auto">
                {{ __('DIAS') }}
            </label>
                    
            <div class="col-md-1">
                <input id="dias" type="text" class="form-control @error('dias') is-invalid @enderror" name="dias" value="{{ old('dias') }}" required autocomplete="dias">
                    @error('dias')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="col-md-4">
                <input id="dias_l" type="text" placeholder="Literal" class="form-control @error('dias') is-invalid @enderror" name="dias_l" value="{{ old('dias') }}" required autocomplete="dias">
                    @error('dias')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div>



        <div class="form-group row">
            <label for="saldo_dias" class="col-md-3 col-form-label text-md-right ml-auto">
                {{ __('SALDO DIAS DE VACACION') }}
            </label>
                    
            <div class="col-md-1">
                <input id="saldo_dias" name="saldo_dias" type="text" class="form-control @error('dias') is-invalid @enderror" value="{{ old('dias') }}" required autocomplete="saldo_dias">
                    @error('dias')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="col-md-4">
                <input id="saldo_dias_l" type="text" placeholder="Literal" class="form-control @error('dias') is-invalid @enderror" name="saldo_dias_l" value="{{ old('dias') }}" required autocomplete="dias">
                    @error('dias')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div>
        
        <div class="row justify-content-center" style="margin-top:100px;">
            <div class="col-3">
                <div class="form-group row d-flex justify-content-center">
                <h5>FUNCIONARIO</h5>
                    <label class="text-center w-100">
                    {{Auth::user()->nombre}} {{Auth::user()->paterno}} {{Auth::user()->materno}}
                    </label>  
                    <label class="text-center">{{Auth::user()->cargo}}</label>      
                </div>
            </div>
        </div>

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
document.getElementById("dias_v").addEventListener("keyup",function(e){
    var letras = NumeroALetras(this.value);
    $("#dias_v_l").val(letras);
    var val1= $("#dias_v").val();
    var val2= $("#dias").val();
    if(val2 == "")
    {
        val2=0;
    }
    $("#saldo_dias").val(parseInt(val1)-parseInt(val2));

});
document.getElementById("dias").addEventListener("keyup",function(e){
    var letras = NumeroALetras(this.value);
    $("#dias_l").val(letras);
    var val1= $("#dias_v").val();
    var val2= $("#dias").val();
    if(val1 == "")
    {
        val1=0;
    }
    $("#saldo_dias").val(parseInt(val1)-parseInt(val2));
});
document.getElementById("dias").addEventListener("keyup",function(e){
    var valor = $("#saldo_dias").val();
    var letras = NumeroALetras(valor);
    $("#saldo_dias_l").val(letras);
});
document.getElementById("dias_v").addEventListener("keyup",function(e){
    var valor = $("#saldo_dias").val();
    var letras = NumeroALetras(valor);
    $("#saldo_dias_l").val(letras);
});
function Unidades(num){
 
  switch(num)
  {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }
 
  return "";
}
 
function Decenas(num){
 
  decena = Math.floor(num/10);
  unidad = num - (decena * 10);
 
  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()
 
function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)
 
  return strSin;
}//DecenasY()
 
function Centenas(num){
 
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
 
  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }
 
  return Decenas(decenas);
}//Centenas()
 
function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  letras = "";
 
  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;
 
  if (resto > 0)
    letras += "";
 
  return letras;
}//Seccion()
 
function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMiles = Seccion(num, divisor, "MIL", "MIL");
  strCentenas = Centenas(resto);
 
  if(strMiles == "")
    return strCentenas;
 
  return strMiles + " " + strCentenas;
 
  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
}//Miles()
 
function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);
 
  if(strMillones == "")
    return strMiles;
 
  return strMillones + " " + strMiles;
 
  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
}//Millones()
 
function NumeroALetras(num){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
  };

  if(data.enteros == 0)
    return "CERO ";
  if(data.enteros < 0)
    return "EL VALOR NO PUEDE SER NEGATIVO";
  if (data.enteros == 1)
    return Millones(data.enteros)+" DIA";
  else
    return Millones(data.enteros)+" DIAS";
}//NumeroALetras()

</script>
@endsection