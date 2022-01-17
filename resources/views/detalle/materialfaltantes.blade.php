@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('materialfaltante.update', $mat->id  ) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class=" row d-flex justify-content-center mt-5">
                            <div class="col-2">
                                <div class="form-group row d-flex justify-content-center p-2">
                                    <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <h2 class="text-center text-primary">SOLICITUD DE MATERIAL</h2>
                            </div>
                            <div class="col-2 d-flex align-items-center justify-content-end">
                                <h4 style="color:red">Nro. {{$mat->id}}</h4>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center mt-4">
                            <label for="direc" class="col-md-2 col-form-label">{{ __('Codigo') }}</label>
                            <div class="col-md-3">
                                <input id="codigo" type="text" value="{{$mat->codigo}}" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" autocomplete="codigo">
                            </div>
                            <label for="direc" class="col-md-2 col-form-label">{{ __('Cantidad') }}</label>
                            <div class="col-md-3">
                                <input id="direc" type="text" value="{{$mat->nombre_contac}}" class="form-control @error('direc') is-invalid @enderror" name="direc" value="{{ old('direc') }}" autocomplete="direc">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            <label for="direc" class="col-md-2 col-form-label">{{ __('Material') }}</label>
                            <div class="col-md-8">
                                <input id="material" type="text" value="{{$mat->material}}" class="form-control @error('material') is-invalid @enderror" name="material" value="{{ old('materia') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            <label for="direc" class="col-md-2 col-form-label">{{ __('Motivo de Solicitud') }}</label>
                            <div class="col-md-8">
                                <input id="motivo" type="text" value="{{$mat->motivo}}" class="form-control @error('motivo') is-invalid @enderror" name="motivo" value="{{ old('motivo') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            <label for="direc" class="col-md-2 col-form-label">{{ __('Comentario') }}</label>
                            <div class="col-md-8">
                                <textarea type="text" class="form-control" style="height: 70px;" id="coment" name="coment" style="white-space: nowrap;">{{$mat->coment}}</textarea>
                            </div>
                        </div>
                    </div>
                        <div class="form-group row d-flex justify-content-center mt-5">
                            <div class="col-md-2 d-flex justify-content-center">
                                <a href="{{route('materialfaltante.create')}}" class="btn btn-danger">{{ __('CERRAR') }}</a>
                            </div>
                            @if(Auth::user()->id==$mat->user_id)
                            <div class="col-md-2 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                            @endif
                        </div>                                  
                    </form>


                            <div class="row d-flex justify-content-center my-4">
                

                                <div class="col-10 d-flex justify-content-center">          
                                    @if($s=$mat->estados->where('estado', 'Cancelado')->first()) 
                                        <button type="button" class="btn btn-sm btn-info rounded-0" data-toggle="modal" data-target="#seguimiento">
                                            {{ __('PEDIDO CANCELADO') }}
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="seguimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('materialfaltante.estado', $mat->id  ) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="PATCH">
                                                        
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Seguimiento</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <textarea class="form-control" style="height: 160px;" style="white-space: nowrap;">{{$s->descripcion}}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if($mat->user->id == auth()->id())  
                                            @if(!$mat->estados->where('estado', 'EnProceso')->first())
                                            @if(!$mat->estados->where('estado', 'NoConseguido')->first())
                                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-toggle="modal" data-target="#seguimiento" @if($mat->user_id !== Auth::user()->id) disabled @endif>
                                                {{ __('CANCELAR PEDIDO') }}
                                            </button>                                        
                                            <!-- Modal -->
                                            <div class="modal fade" id="seguimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('materialfaltante.estado', $mat->id  ) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="PATCH">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cancelar Pedido</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea id="descripcion" name="descripcion" type="text" class="form-control" style="height: 160px;" placeholder="Motivo de Cancelación" style="white-space: nowrap;">
                                                                </textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary" id="estado" name="estado" value="Cancelado">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endif
                                        @endif
                                    @endif  
                                      
                                    @if($p=$mat->estados->where('estado', 'EnProceso')->first()) 
                                        <button type="button" class="btn btn-sm rounded-0" style="background-color: paleturquoise;" data-toggle="modal" data-target="#EnProceso">
                                            {{ __('EN PROCESO') }}
                                        </button>
                                            
                                        <!-- Modal -->
                                        <div class="modal fade" id="EnProceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">                                                                                
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ENTREGA PARCIAL</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Fecha y hora: </strong><p>{{$p->created_at}}</p>
                                                        <strong>Usuario: </strong><p> {{$p->user->nombre}} {{$p->user->paterno}} {{$p->user->materno}}</p>
                                                        <strong>Comentario: </strong><p>{{$p->descripcion}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($p=$mat->estados->where('estado', 'Parcial')->first()) 
                                        <button type="button" class="btn btn-sm bg-warning rounded-0" data-toggle="modal" data-target="#parcial">
                                            {{ __('ENTREGA PARCIAL') }}
                                        </button>
                                            
                                        <!-- Modal -->
                                        <div class="modal fade" id="parcial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">                                                                                
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ENTREGA PARCIAL</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Fecha y hora: </strong><p>{{$p->created_at}}</p>
                                                        <strong>Usuario: </strong><p> {{$p->user->nombre}} {{$p->user->paterno}} {{$p->user->materno}}</p>
                                                        <strong>Comentario: </strong><p>{{$p->descripcion}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @elseif(!$mat->estados->where('estado', 'Cancelado')->first()) 
                                            @if(!$mat->estados->where('estado', 'NoConseguido')->first())
                                                @if(!$mat->estados->where('estado', 'Total')->first())
                                                @if(Auth::user()->authorizePermisos(['materialfaltante_form']))
                                                    <button type="button" class="btn btn-sm btn-secondary rounded-0" data-toggle="modal" data-target="#parcial">
                                                        {{ __('ENTREGA PARCIAL') }}
                                                    </button>
                                                    {{$mat->estados->where('estado', 'Total')->first()}}
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="parcial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="{{ route('materialfaltante.estado', $mat->id  ) }}">
                                                                    @csrf
                                                                    <input name="_method" type="hidden" value="PATCH">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">ENTREGA PARCIAL</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <textarea id="descripcion" name="descripcion" type="text" class="form-control" style="height: 160px;" placeholder="Descripcion de Seguimiento" style="white-space: nowrap;">
                                                                        </textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-warning" id="estado" name="estado" value="Parcial">Entrega Parcial</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @endif
                                            @endif
                                        @endif

                                        @if($t=$mat->estados->where('estado', 'Total')->first()) 
                                        <button type="button" class="btn btn-sm bg-success rounded-0" data-toggle="modal" data-target="#total">
                                            {{ __('ENTREGA TOTAL') }}
                                        </button>
                                            
                                        <!-- Modal -->
                                        <div class="modal fade" id="total" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">                                                                                
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ENTREGA TOTAL</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Fecha y hora: </strong><p>{{$t->created_at}}</p>
                                                        <strong>Usuario: </strong><p> {{$t->user->nombre}} {{$p->user->paterno}} {{$t->user->materno}}</p>
                                                        <strong>Comentario: </strong><p>{{$t->descripcion}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @elseif(!$mat->estados->where('estado', 'Cancelado')->first()) 
                                            @if(!$mat->estados->where('estado', 'NoConseguido')->first())
                                                @if(Auth::user()->authorizePermisos(['materialfaltante_form']))
                                                    <button type="button" class="btn btn-sm btn-secondary rounded-0" data-toggle="modal" data-target="#total">
                                                        {{ __('ENTREGA TOTAL') }}
                                                    </button>
                                                    {{$mat->estados->where('estado', 'Total')->first()}}
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="total" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="{{ route('materialfaltante.estado', $mat->id  ) }}">
                                                                    @csrf
                                                                    <input name="_method" type="hidden" value="PATCH">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">ENTREGA TOTAL</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <textarea id="descripcion" name="descripcion" type="text" class="form-control" style="height: 160px;" placeholder="Descripcion de Seguimiento" style="white-space: nowrap;">
                                                                        </textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-warning" id="estado" name="estado" value="Total">Entrega Total</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    @elseif(!$mat->estados->where('estado', 'Cancelado')->first()) 
                                        @if(!$mat->estados->where('estado', 'NoConseguido')->first())
                                            @if(Auth::user()->authorizePermisos(['materialfaltante_form']))
                                                <button type="button" class="btn btn-sm btn-secondary rounded-0" data-toggle="modal" data-target="#EnProceso">
                                                    {{ __('EN PROCESO') }}
                                                </button>
                                                {{$mat->estados->where('estado', 'Total')->first()}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="EnProceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ route('materialfaltante.estado', $mat->id  ) }}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="PATCH">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">PEDIDO EN PROCESO</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <textarea id="descripcion" name="descripcion" type="text" class="form-control" style="height: 160px;" placeholder="En proceso" style="white-space: nowrap;">
                                                                    </textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-warning" id="estado" name="estado" value="EnProceso">Pedido En Proceso</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif

                                    

                                    
                                        @if($i=$mat->estados->where('estado', 'NoConseguido')->first()) 
                                            <button type="button" class="btn btn-sm bg-danger rounded-0" data-toggle="modal" data-target="#adjudicado">
                                                {{ __('NO CONSEGUIDO') }}
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="adjudicado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        
                                                            
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">No Conseguido</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <strong>Fecha y hora: </strong><p>{{$i->created_at}}</p>
                                                                <textarea type="text" class="form-control" style="height: 160px;" style="white-space: nowrap;">{{$i->descripcion}}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif(!$mat->estados->where('estado', 'Total')->first()) 
                                            @if(Auth::user()->authorizePermisos(['materialfaltante_form']))
                                                @if(!$mat->estados->where('estado', 'Cancelado')->first()) 
                                                <button type="button" class="btn btn-sm btn-secondary rounded-0" data-toggle="modal" data-target="#NoConseguido">
                                                    {{ __('NO CONSEGUIDO') }}
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="NoConseguido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ route('materialfaltante.estado', $mat->id  ) }}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="PATCH">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">No conseguido</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <textarea id="descripcion" name="descripcion" type="text" class="form-control" style="height: 160px;" placeholder="No consegui el material porque..." style="white-space: nowrap;">
                                                                    </textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-danger" id="estado" name="estado" value="NoConseguido">No Conseguido</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                        @endif
                                </div>
                            </div>

                        
                        
                    
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                                          
                                                <p for="nombre" class="text-md-center" style="font-size: 1.1rem;">{{ __('FUNCIONARIO: ') }}{{$user->nombre}} {{$user->paterno}} {{$user->materno}}</p>
                                                <p for="sucursal" class="text-md-center" style="font-size: 1.1rem;">{{ __('SUCURSAL: ') }}{{$user->sucursal}}</p>
                                                <p for="nombre" class="text-md-center" style="font-size: 1.1rem;">{{ __('FECHA: ') }}{{$mat->created_at}}</p>
                                                <p for="sucursal" class="text-md-center" style="font-size: 1.1rem;">{{ __('UNIDAD DE TRABAJO: ') }}{{$user->area}}</p>

                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
