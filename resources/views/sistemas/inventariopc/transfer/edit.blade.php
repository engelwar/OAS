@extends('layouts.app')
@section('title', 'Inicio')
@section('content') 
<div class="wrapper">
  @include('layouts.lateralbar')
    <div class="container-fluid m-3 ancho_container"> 
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="solicitud-tab" data-toggle="tab" href="#solicitud" role="tab" aria-controls="solicitud" aria-selected="true">Transferencia</a>
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
                <div class="row py-3">
                    <div class="col">
                        <h5><b>Nombre PC:</b> {{$pc->nombre}} </h5>
                        <h5><b>ID:</b> {{$pc->id}} </h4>
                        <h5><b>Ubicacion:</b> {{$pc->ubicacion}} </h5>
                        <h5>
                            <b>Asignado a:</b>
                            @if($pc->funcionario)
                                {{$pc->funcionario->nombre}} 
                                <span class="badge bg-secondary">
                                    <a>x</a>
                                </span>
                            @else
                                N/A
                            @endif
                        </h5>
                        <p>
                            
                        </p>
                    </div>
                    <div class="col-5">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm table-bordered" >
                                <thead>
                                    <th style="width: 50%">Nombre</th>
                                    <th>PC asignada</th>
                                    <th>opciones</th>
                                </thead>
                                <tbody>
                                @if($perfiles->count())
                                @foreach($perfiles as $p)
                                <tr>
                                    <td>{{$p->nombre[0] . '. ' . $p->nombre}}</td>
                                    @if($p->pc->count() >0)
                                    <td>{{$p->pc->count()}}</td> 
                                    @else
                                    <td> N/A</td>
                                    <td>
                                        <form action="{{action('PcTransferController@edit', $p->id, $pc->id)}}" method="post">
                                            {{csrf_field()}}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fas fa-sign-in-alt"></i>
                                            </button>
                                            <div class="modal fade text-dark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminacion</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Transferir la PC a este Perfil?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger" type="submit">Transferir<span class="glyphicon glyphicon-trash"></span></button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </form>                                        
                                    </td>
                                    @endif            
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
            </div>
            <div class="tab-pane fade" id="fin" role="tabpanel" aria-labelledby="fin-tab">.dd..</div>
        </div>                              
    </div>          
</div>
@endsection