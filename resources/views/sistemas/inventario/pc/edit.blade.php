@extends('layouts.app')

@section('mi_estilo')
 <style>
     @media (min-width: 600px) {
  .container_pad {
    padding:60px;
    padding-top: 0px;
  }
}
 </style>
@endsection

@section('content')
<div class="container_pad">
    <form method="POST" action="{{ route('inventariosistemas.update', $pc->id) }}">
        @csrf
        @method('PATCH')
        <div class="row d-flex justify-content-end pt-4">    
            <div class="col-10">
                <div class="row mb-2">
                    <label for="nombre" class="col-md-2 col-form-label col-form-label-sm">
                        {{ __('Nombre de Equipo') }}
                    </label>           
                    <div class="col-md-10">
                        <input id="nombre" value="{{$pc->nombre}}" type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror" name="nombre" autocomplete="OFF">
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="area" class="col-md-2 col-form-label col-form-label-sm">
                        {{ __('Area') }}
                    </label>    
                    <div class="col-md-3">
                        <input value="{{$pc->area}}" id="area" type="text" class="form-control form-control-sm @error('area') is-invalid @enderror" name="area">
                        @error('area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="funcionario" class="col-md-1 col-form-label col-form-label-sm">
                        {{ __('Funcionario') }}
                    </label>                    
                    <div class="col-md-3">
                        <input id="funcionario" value="{{$pc->funcionario}}" type="ci" class="form-control form-control-sm @error('funcionario') is-invalid @enderror" name="funcionario">
                        @error('funcionario')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="ci" class="col-md-1 col-form-label col-form-label-sm">
                        {{ __('CI') }}
                    </label>                    
                    <div class="col-md-2">
                        <input id="ci" type="ci" value="{{$pc->ci}}" class="form-control form-control-sm @error('ci') is-invalid @enderror" name="ci">
                        @error('ci')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="ip" class="col-md-2 col-form-label col-form-label-sm">
                        {{ __('IP') }}
                    </label>
                            
                    <div class="col-md-3">
                        <input id="ip" type="text" value="{{$pc->ip}}" class="form-control form-control-sm @error('ip') is-invalid @enderror" name="ip" autocomplete="OFF">
                        @error('ip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label for="ubicacion" class="col-md-1 col-form-label col-form-label-sm">
                        {{ __('Ubicacion') }}
                    </label>                    
                    <div class="col-md-3">
                        <input id="ubicacion" value="{{$pc->ubicacion}}"type="ubicacion" class="form-control form-control-sm @error('ubicacion') is-invalid @enderror" name="ubicacion">
                        @error('Ubicacion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label for="estado" class="col-md-1 col-form-label col-form-label-sm">
                        Estado
                    </label>
                    <div class="col-md-2">
                        <select id="estado" name="estado" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="{{null}}" class="text-secondary" selected>Seleccione Estado</option>
                            <option value="1" @if($pc->estado == "1") selected @endif>
                                Funcional
                            </option>
                            <option value="2" @if($pc->estado == "2") selected @endif>
                                En Mal Estado
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="observaciones" class="col-md-2 col-form-label col-form-label-sm">
                        {{ __('Observaciones') }}
                    </label>
                            
                    <div class="col-md-10">
                        <input id="observaciones" type="text" value="{{$pc->observaciones}}" class="form-control form-control-sm @error('observaciones') is-invalid @enderror" name="observaciones" autocomplete="OFF">
                        @error('observaciones')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="perfil_id" class="col-md-2 col-form-label col-form-label-sm">
                        Funcionario
                    </label>
                            
                    <div class="col-md-4">
                        <select id="perfil_id" name="perfil_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            @if(count($perfiles))
                                <option value="{{null}}" class="text-secondary" selected>Seleccione Funcionario</option>
                                @foreach($perfiles as $p)
                                    <option value="{{$p->id}}" @if($pc->perfil_id == $p->id) selected @endif>{{$p->nombre}} {{$p->paterno}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <label for="tipo" class="col-md-2 col-form-label col-form-label-sm">
                        Tipo
                    </label>                            
                    <div class="col-md-4">
                        <select id="tipo" name="tipo" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="{{null}}" selected class="text-secondary">Seleccione Tipo de PC</option>
                            <option value="1" @if($pc->tipo == "1") selected @endif>
                                De Escritorio
                            </option>
                            <option value="2" @if($pc->tipo == "2") selected @endif>
                                Laptop
                            </option>
                            <option value="3" @if($pc->tipo == "3") selected @endif>
                                Servidor
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 d-flex align-items-center justify-content-center">   
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($qr)) !!}" class="img-fluid">
            </div>
        </div>

        <div class="row col d-flex justify-content-center mt-5">
            <div class="table-responsive">
                <div>
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
                        <th>OP</th>
                        </thead>
                        <tbody>
                        @foreach($disp as $di)
                        <tr>
                            <td>
                                <input id="a_tipo[{{$di->id}}]" type="text" value="{{$di->tipo}}" class="form-control @error('tipo') is-invalid @enderror" name="a_tipo[{{$di->id}}]">
                                @error('a_tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            <td >
                                <input id="a_marca[{{$di->id}}]" type="text" value="{{$di->marca}}"  class="form-control @error('marca') is-invalid @enderror" name="a_marca[{{$di->id}}]">
                                @error('marca')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            <td>
                                <input id="a_modelo[{{$di->id}}]" value="{{$di->modelo}}"  type="text" class="form-control @error('modelo') is-invalid @enderror" name="a_modelo[{{$di->id}}]">
                                @error('modelo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            <td>
                                <input id="a_num_serie[{{$di->id}}]" value="{{$di->num_serie}}"  type="text" class="form-control @error('num_serie') is-invalid @enderror" name="a_num_serie[{{$di->id}}]">
                                @error('num_serie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            
                            <td>
                                <input id="a_caracteristicas[{{$di->id}}]" value="{{$di->caracteristicas}}"  type="text" class="form-control @error('caracteristicas') is-invalid @enderror" name="a_caracteristicas[{{$di->id}}]">
                                @error('caracteristicas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            <td>
                                <input id="a_estado[{{$di->id}}]" type="text" value="{{$di->estado}}" class="form-control @error('estado') is-invalid @enderror estado" name="a_estado[{{$di->id}}]">
                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td> 
                            <td>
                                <button class="quitar btn btn-danger btn-sm" type="button" id="{{$di->id}}"><i class="fas fa-sign-out-alt"></i></button>
                            </td>               
                        </tr>
                        @endforeach
                        <tr>
                            <td><input id="tipo_a[]" type="text" class="form-control @error("tipo_a[]") is-invalid @enderror" name="tipo_a[]"></td>
                            <td><input id="marca[]" type="text" class="form-control @error("marca[]") is-invalid @enderror" name="marca[]"></td>
                            <td><input id="modelo[]" type="text" class="form-control @error("modelo[]") is-invalid @enderror" name="modelo[]"></td>
                            <td><input id="num_serie[]" type="text" class="form-control @error("num_serie[]") is-invalid @enderror" name="num_serie[]"></td>         
                            <td><input id="caracteristicas[]" type="text" class="form-control @error("caracteristicas[]") is-invalid @enderror" name="caracteristicas[]"></td>
                            <td><input id="estado_n[]" type="text" class="form-control @error("estado_n[]") is-invalid @enderror" name="estado_n[]"></td>
                            <td><button class="quitar btn btn-danger btn-sm" type="button" id="{{$di->id}}"><i class="fas fa-save"></i></button></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                
            </div>
        </div>

        <div class="row mb-3">
            <div class="col d-flex justify-content-end ">
                <!--a class="delete-row btn btn-danger btn-xs text-light mr-2">-</a-->
                <a class="first add-row btn btn-primary btn-xs text-light">Crear</a>
            </div>
        </div>  
            <input type="hidden" id="cont" name="cont" value="0">
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
        var cont = 0;
        $(".add-row").click(function()
        {
            var markup = '<tr>'+
            '<td><input id="tipo[]" type="text" class="form-control @error("tipo[]") is-invalid @enderror" name="tipo[]"></td>'+
            '<td><input id="marca[]" type="text" class="form-control @error("marca[]") is-invalid @enderror" name="marca[]"></td>'+
            '<td><input id="modelo[]" type="text" class="form-control @error("modelo[]") is-invalid @enderror" name="modelo[]"></td>'+
            '<td><input id="num_serie[]" type="text" class="form-control @error("num_serie[]") is-invalid @enderror" name="num_serie[]"></td>'+            
            '<td><input id="caracteristicas[]" type="text" class="form-control @error("caracteristicas[]") is-invalid @enderror" name="caracteristicas[]"></td>'+
            '<td><input id="estado_n[]" type="text" class="form-control @error("estado_n[]") is-invalid @enderror" name="estado_n[]"</td>'+
            '</tr>';
            $("table#tabla tbody").append(markup);
            cont = cont +1;
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
        $(".quitar").click(function(e){
            console.log($(this).attr("id"));
        });   
    }); 
</script>

@endsection