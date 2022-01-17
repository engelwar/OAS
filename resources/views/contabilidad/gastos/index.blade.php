@extends('layouts.app')
@section('title', 'Inicio')
@section('mi_estilo')
 <style>
th, .centrar
{
    text-align: center; 
    vertical-align: middle !important;
}
 </style>
@endsection
@section('content') 
<div class="wrapper">
  @include('layouts.lateralbar')
    <div class="container-fluid m-3 ancho_container"> 
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="solicitud-tab" data-toggle="tab" href="#solicitud" role="tab" aria-controls="solicitud" aria-selected="true">Solicitudes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="rendicion-tab" data-toggle="tab" href="#rendicion" role="tab" aria-controls="rendicion" aria-selected="false">Rendicion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="fin-tab" data-toggle="tab" href="#fin" role="tab" aria-controls="fin" aria-selected="false">Finalizados</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="solicitud" role="tabpanel" aria-labelledby="solicitud-tab">
                <div class="container">
                <div class="row py-3">
                    <div class="col"><h3>Solicitudes <a href="{{ route('solicitudgastos.create') }}" >+</a></h3></div>
                    <!--div class="col-7 col-sm-9 col-md-7 d-sm-flex justify-content-end">
                        <form class="form-inline" action="{{action('UsuarioController@index')}}" method="GET">
                        <select class="form-control mr-sm-2 col-5 col-sm-auto" id="buscar" name="buscar">
                            <option value="1">Nombre</option>
                            <option value="2">CI</option>
                        </select>
                        <input id="busca" name="busca" class="form-control col-4 col-sm-auto ml-auto"type="search" placeholder="Buscar" aria-label="Search">
                        <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
                        </form>
                    </div-->
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-bordered" >
                        <thead>
                            <th style="width: 10%;">Fecha</th>
                            <th style="width: 13%">Centro de Costo</th>
                            <th style="width: 19%">Tipo de Gasto</th>
                            <th style="width: 20%">Gasto Solicitado</th>
                            <th style="width: 20%">Motivo</th>
                            <th>Monto Solicitado</th>
                            <th>Estado</th>
                            @if(Auth::user()->authorizepermisos(['edit_users'])) 
                            <th style="width: 120px;">Opciones</th>
                            @endif
                        </thead>
                        <tbody>
                        @if($solicitud->count())
                        @foreach($solicitud as $s)
                        <tr>
                            <td style="text-align:center">{{$s->fecha}}</td>
                            <td>{{$s->centro_c}}</td>
                            <td>{{$s->cuenta_c}}</td>
                            <td>{{$s->detalle}}</td>
                            <td>{{$s->motivo}}</td>
                            <td>{{$s->monto}}</td>
                            <td style="text-align:center">
                            @if($s->estado == 0)                            
                            <i class="fas fa-thumbs-down text-danger"></i>
                            @elseif($s->estado == 1)
                            <i class="fas fa-ellipsis-h"></i>
                            @elseif($s->estado == 2)
                            <i class="fas fa-thumbs-down text-primary"></i>
                            @endif
                            
                            </td>
                            
                            <td style="text-align:center">
                            @if($s->perfil_id == Auth::user()->perfiles->id)
                                <a class="btn btn-danger btn-sm" href="" ><span class="glyphicon glyphicon-pencil"><i class="fas fa-window-close"></i></i></span></a>
                            @endif
                            </td>               
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>No hay registro !!</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <div class="tab-pane fade" id="rendicion" role="tabpanel" aria-labelledby="rendicion-tab">
                <div class="row py-3">
                    <div class="col"><h3>Rendicion de Gastos <a href="{{ route('solicitudgastos.create') }}" >+</a></h3></div>
                    <div class="col-7 col-sm-9 col-md-7 d-sm-flex justify-content-end">
                        <form class="form-inline" action="{{action('UsuarioController@index')}}" method="GET">
                        <select class="form-control mr-sm-2 col-5 col-sm-auto" id="buscar" name="buscar">
                            <option value="1">Nombre</option>
                            <option value="2">CI</option>
                        </select>
                        <input id="busca" name="busca" class="form-control col-4 col-sm-auto ml-auto"type="search" placeholder="Buscar" aria-label="Search">
                        <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-bordered" >
                        <thead>
                            <th style="width: 30%">Nombre</th>
                            <th>CI</th>
                            <th>Area</th>
                            <th>Unidad</th>
                            @if(Auth::user()->authorizepermisos(['edit_users'])) 
                            <th style="width: 120px;">Opciones</th>
                            @endif
                        </thead>
                        <tbody>
                        @if($gastos->count())
                        @foreach($gastos as $g)
                        <tr>
                            <td>{{$g->nombre." ".$g->paterno." ". $g->materno}}</td>
                            <td>{{$g->ci}} {{$g->ci_e}}</td>
                            <td>{{$g->area}}</td>
                            @if($g->unidades)
                            <td>{{$g->unidades->nombre}}</td>
                            @else
                            <td class="text-danger">No Asignada</td>
                            @endif
                            @if(Auth::user()->authorizepermisos(['edit_users'])) 
                            <td><a class="btn btn-primary btn-sm" href="{{action('PerfilController@edit', $g->id)}}" ><span class="glyphicon glyphicon-pencil"><i class="far fa-address-card"></i></span></a>
                            @endif  
                            @if($g->user)
                            <a class="btn btn-primary btn-sm" href="{{action('UsuarioController@edit', $g->user->id)}}" ><span class="glyphicon glyphicon-pencil"><i class="fas fa-user-cog"></i></span></a>
                            <a class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-pencil"><i class="fas fa-minus"></i></a>
                            @else
                            <a class="btn btn-success btn-sm" href="{{action('UsuarioController@create', $g->id)}}" ><span class="glyphicon glyphicon-pencil"><i class="fas fa-plus"></i></a>
                            @endif
                            </td>               
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>No hay registro !!</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $gastos->links() }}
                </div>
            </div>
            <div class="tab-pane fade" id="fin" role="tabpanel" aria-labelledby="fin-tab">.dd..</div>
        </div>                              
    </div>          
</div>
@endsection
