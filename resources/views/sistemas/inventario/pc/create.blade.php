@extends('layouts.app')

@section('mi_estilo')
 <style>
     @media (min-width: 600px) {
  .container_pad {
    padding:50px;
    padding-top: 30px; 
    padding-bottom:0;
  }
}
 </style>
@endsection

@section('content')
<div class="center container_pad">
                    <form method="POST" action="{{ route('inventariosistemas.store') }}">
                        @csrf
                        
                        <div class=" row d-flex justify-content-center">
                            <div class="col-lg-6 col-sm-12 d-flex align-items-center justify-content-center">
                                <h3 class="text-center text-primary">REGISTRO DE EQUIPOS</h3>
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="nombre" class="col-md-2 col-form-label">
                                {{ __('Nombre de Equipo') }}
                            </label>
                                    
                            <div class="col-md-4">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" autocomplete="OFF">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="ip" class="col-md-1 col-form-label">
                                {{ __('IP') }}
                            </label>
                                    
                            <div class="col-md-2">
                                <input id="ip" type="text" class="form-control @error('ip') is-invalid @enderror" name="ip" autocomplete="OFF">
                                @error('ip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="area" class="col-md-1 col-form-label">
                                {{ __('Area') }}
                            </label>    
                            <div class="col-md-2">
                                <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area"  autocomplete="OFF">
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            

                            <label for="funcionario" class="col-md-2 col-form-label">
                                {{ __('Funcionario') }}
                            </label>                    
                            <div class="col-md-3">
                                <input id="funcionario" type="ci" class="form-control @error('funcionario') is-invalid @enderror" name="funcionario"  autocomplete="OFF">
                                @error('funcionario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="ci" class="col-md-1 col-form-label">
                                {{ __('CI') }}
                            </label>                    
                            <div class="col-md-2">
                                <input id="ci" type="ci" class="form-control @error('ci') is-invalid @enderror" name="ci"  autocomplete="OFF">
                                @error('ci')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            
                            <label for="ubicacion" class="col-md-1 col-form-label">
                                {{ __('Ubicacion') }}
                            </label>                    
                            <div class="col-md-3">
                                <input id="ubicacion" type="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" name="ubicacion"  autocomplete="OFF">
                                @error('Ubicacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="estado" class="col-md-1 col-form-label">
                                {{ __('Estado') }}
                            </label>                    
                            <div class="col-md-2">
                                <input id="estado" type="estado" class="form-control @error('estado') is-invalid @enderror" name="estado"  autocomplete="OFF">
                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
            
                        </div>
                        <div class="form-group row">
                            <label for="observaciones" class="col-md-2 col-form-label">
                                {{ __('Observaciones') }}
                            </label>
                                    
                            <div class="col-md-10">
                                <input id="observaciones" type="text" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" autocomplete="OFF">
                                @error('observaciones')
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
                                        <th class="align-middle">Tipo</th>
                                        <th style="width:15%;" class="align-middle">Marca</th>
                                        <th style="width:15%;" class="align-middle">Modelo</th>
                                        <th style="width:15%;" class="align-middle">N/S</th>
                                        <th style="width:25%;" class="align-middle">Caracteristicas</th>
                                        <th class="align-middle">Estado</th>
                                     </thead>
                                     <tbody>
                                         @for($i = 1; $i <= $cont; $i++)
                                        <tr>
                                        <td>
                                            <input id="tipo{{$i}}" type="text" value="" class="form-control @error('tipo') is-invalid @enderror" name="tipo{{$i}}">
                                            @error('tipo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td >
                                            <input id="marca{{$i}}" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca{{$i}}" required>
                                            @error('marca')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="modelo{{$i}}" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo{{$i}}">
                                            @error('modelo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="num_serie{{$i}}" type="text" class="form-control @error('num_serie') is-invalid @enderror" name="num_serie{{$i}}">
                                            @error('num_serie')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        
                                        <td>
                                            <input id="caracteristicas{{$i}}" type="text" class="form-control @error('caracteristicas') is-invalid @enderror" name="caracteristicas{{$i}}">
                                            @error('caracteristicas')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="estado{{$i}}" type="text" class="form-control @error('estado') is-invalid @enderror estado" name="estado{{$i}}">
                                            @error('estado')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>                
                                      </tr>
                                      @endfor
                                    </tbody>
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
        var cont = "{{$cont}}";
        $(".add-row").click(function()
        {
            cont = parseInt(cont) +1;
            
            var markup = '<tr>'+
            '<td><input id="tipo'+cont+'" type="text" class="form-control @error("tipo'+cont+'") is-invalid @enderror" name="tipo'+cont+'"></td>'+
            '<td><input id="marca'+cont+'" type="text" class="form-control @error("marca'+cont+'") is-invalid @enderror" name="marca'+cont+'"></td>'+
            '<td><input id="modelo'+cont+'" type="text" class="form-control @error("modelo'+cont+'") is-invalid @enderror" name="modelo'+cont+'"></td>'+
            '<td><input id="num_serie'+cont+'" type="text" class="form-control @error("num_serie'+cont+'") is-invalid @enderror" name="num_serie'+cont+'"></td>'+ 
            '<td><input id="caracteristicas'+cont+'" type="text" class="form-control @error("caracteristicas'+cont+'") is-invalid @enderror" name="caracteristicas'+cont+'"></td>'+
            '<td><input id="estado'+cont+'" type="text" class="form-control @error("estado'+cont+'") is-invalid @enderror estado" name="estado'+cont+'"</td>'+
            '</tr>';
            $("table#tabla tbody").append(markup);
            $(" #cont").val(cont);
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function()
        {
            cont = parseInt(cont) -1;
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
            $("#cont").val(cont);
        });
               
    }); 
    
</script>

@endsection