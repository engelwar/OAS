@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
<div style="position:fixed; right:100px; z-index: 100;">
    <a href="{{route('cotizacion.create')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i></a>
</div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('cotizacion.update', $cot->id  ) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class=" row d-flex justify-content-center mt-5">
                            <div class="col-2">
                                <div class="form-group row d-flex justify-content-center p-2">
                                    <img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <h2 class="text-center text-primary">DETALLE DE REGISTRO DE COTIZACIONES</h2>
                            </div>
                            <div class="col-2 d-flex align-items-center justify-content-end">
                                <h4 style="color:red">Nro. {{$cot->id}}</h4>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-11 mt-5">
                                <h5>SOLICITANTE</h5>
                            </div>
                            
                        </div>
                        <div class="row d-flex justify-content-center mt-4">
                            <div class="col-6">
                                
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-5 col-form-label text-md-right">{{ __('EMPRESA') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="direc" type="text" value="{{$cot->empresa}}" class="form-control @error('direc') is-invalid @enderror" name="direc" value="{{ old('direc') }}" autocomplete="direc">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-5 col-form-label text-md-right">{{ __('NOMBRE DE CONTACTO') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="direc" type="text" value="{{$cot->nombre_contac}}" class="form-control @error('direc') is-invalid @enderror" name="direc" value="{{ old('direc') }}" autocomplete="direc">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">

                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-6 col-form-label text-md-right">{{ __('UNIDAD') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="direc" type="text" class="form-control @error('direc') is-invalid @enderror" name="direc" value="{{$cot->unid}}" autocomplete="direc">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-6 col-form-label text-md-right">{{ __('TELEFONO DE CONTACTO') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="telf_contac" type="text" class="form-control @error('telf_contac') is-invalid @enderror" name="telf_contac" value="{{$cot->telf_contac}}" required autocomplete="telf_contac">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center mt-4">
                            <div class="col-6">
                                
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="OV" class="col-md-5 col-form-label text-md-right">{{ __('OV') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="OV" type="text" value="{{$cot->OV}}" class="form-control @error('direc') is-invalid @enderror" name="OV" value="{{ old('OV') }}" required autocomplete="direc">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-5 col-form-label text-md-right">{{ __('NUMERO DE LICITACION') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="n_lic" type="text" value="{{$cot->n_lic}}" class="form-control @error('n_lic') is-invalid @enderror" name="n_lic" value="{{ old('n_lic') }}" required autocomplete="n_lic">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-6 col-form-label text-md-right">{{ __('NIT') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="nit" type="text" class="form-control @error('nit') is-invalid @enderror" name="nit" value="{{$cot->nit}}" autocomplete="nit">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-6 col-form-label text-md-right">{{ __('RESPONSABLE DE PROCESO') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="nombre_resp" type="text" class="form-control @error('nombre_resp') is-invalid @enderror" name="nombre_resp" value="{{$cot->nombre_resp}}" required autocomplete="nombre_resp">
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center mt-5">
                                    <div class="col-5 ">
                                    <H4>DESCRIPCION</H4>
                                    <textarea type="text" class="form-control" style="height: 160px;" placeholder="DESCRIPCION " id="descrip" name="descrip" style="white-space: nowrap;">{{$cot->descrip}}</textarea>
                                    @error('obs')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>La observacion es necesaria para rechazar el formulario</strong>
                                        </div>
                                    @enderror
                                    </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center mt-5">
                           
                                    @if(Auth::user()->id==$cot->user_id)
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>

                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </div>
                                    @endif
                        </div>
                    </form>


                            <div class="row d-flex justify-content-center my-4">
                
                            
                                <div class="col-10 d-flex justify-content-center">
                                    @if($s=$cot->estados->where('estado', 'Seguimiento')->first()) 
                                        <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento">
                                            {{ __('SEGUIMIENTOS') }} <i class="fas fa-check fa-lg"></i>   
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="seguimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('cotizacion.estado', $cot->id  ) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="PATCH">
                                                        
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Seguimiento</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:130px">Fecha y hora</th>
                                                                        <th>Seguimiento</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if($segui=$cot->estados->where('estado', 'Seguimiento')) 
                                                                    @foreach($segui as $s)
                                                                    <tr>
                                                                    <td>{{$s->created_at}}</td>
                                                                    <td>{{$s->descripcion}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                @else
                                                                    NO HAY REGISTRO!!
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                            <strong>Agregar Nuevo Seguimiento </strong><p></p>
                                                            <textarea id="descripcion" name="descripcion" type="text" class="form-control" style="height: 160px;" placeholder="Descripcion de Seguimiento" style="white-space: nowrap;">
                                                            </textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary" id="estado" name="estado" value="Seguimiento">Nuevo Seguimiento</button>
                                                        </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(!$cot->estados->where('estado', 'Rechazado')->first())
                                        <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento" @if($cot->user_id !== Auth::user()->id) disabled @endif>
                                            {{ __('SEGUIMIENTO') }} <i class="fas fa-check fa-lg"></i>  
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="seguimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('cotizacion.estado', $cot->id  ) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="PATCH">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Seguimiento</h5>
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
                                                            <button type="submit" class="btn btn-primary" id="estado" name="estado" value="Seguimiento">Seguir</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($a=$cot->estados->where('estado', 'Adjudicado')->first()) 
                                        <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado">
                                            {{ __('ADJUDICADO') }}
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="adjudicado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    
                                                        
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Adjudicado</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <strong>Fecha y hora: </strong><p>{{$a->created_at}}</p>
                                                            <textarea type="text" class="form-control" style="height: 160px;" style="white-space: nowrap;">{{$a->descripcion}}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(!$cot->estados->where('estado', 'Rechazado')->first()) 
                                        <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado" @if($cot->user_id !== Auth::user()->id) disabled @endif>
                                            {{ __('ADJUDICADO') }}
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="adjudicado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('cotizacion.estado', $cot->id  ) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="PATCH">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Adjudicado</h5>
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
                                                            <button type="submit" class="btn btn-primary bg-adjud" id="estado" name="estado" value="Adjudicado">Adjudicar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                             
                                    @if($a=$cot->estados->where('estado', 'Rechazado')->first()) 
                                        <button type="button" class="btn btn-sm bg-danger rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado">
                                            {{ __('RECHAZADO') }}
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="adjudicado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    
                                                        
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Rechazado</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <strong>Fecha y hora: </strong><p>{{$a->created_at}}</p>
                                                            <textarea type="text" class="form-control" style="height: 160px;" style="white-space: nowrap;">{{$a->descripcion}}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(!$cot->estados->where('estado', 'Adjudicado')->first()) 
                                        <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#rechazado" @if($cot->user_id !== Auth::user()->id) disabled @endif>
                                            {{ __('RECHAZADO') }}
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="rechazado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('cotizacion.estado', $cot->id  ) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="PATCH">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Rechazado</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <textarea id="descripcion" name="descripcion" type="text" class="form-control" style="height: 160px;" placeholder="Descripcion de Rechazo" style="white-space: nowrap;">
                                                            </textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-danger" id="estado" name="estado" value="Rechazado">Rechazar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($a=$cot->estados->where('estado', 'Adjudicado')->first()) 
                                        @if($p=$cot->estados->where('estado', 'Parcial')->first()) 
                                            <button type="button" class="btn btn-sm bg-warning rounded-0" data-bs-toggle="modal" data-bs-target="#parcial">
                                                {{ __('ENTREGA PARCIAL') }}
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="parcial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        
                                                            
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Adjudicado</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <strong>Fecha y hora: </strong><p>{{$p->created_at}}</p>
                                                                <textarea type="text" class="form-control" style="height: 160px;" style="white-space: nowrap;">{{$p->descripcion}}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif(!$cot->estados->where('estado', 'Total')->first()) 
                                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#parcial">
                                                {{ __('ENTREGA PARCIAL') }}
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="parcial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('cotizacion.estado', $cot->id  ) }}">
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
                                                                <button type="submit" class="btn btn-warning" id="estado" name="estado" value="Parcial">Entrega Parcial</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($p=$cot->estados->where('estado', 'Total')->first()) 
                                            <button type="button" class="btn btn-sm bg-success rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado">
                                                {{ __('ENTREGA TOTAL') }}
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="adjudicado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        
                                                            
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Entregua Total</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <strong>Fecha y hora: </strong><p>{{$p->created_at}}</p>
                                                                <textarea type="text" class="form-control" style="height: 160px;" style="white-space: nowrap;">{{$p->descripcion}}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else 
                                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#total">
                                                {{ __('ENTREGA TOTAL') }}
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="total" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('cotizacion.estado', $cot->id  ) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="PATCH">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Entrega Total</h5>
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
                                                                <button type="submit" class="btn btn-success" id="estado" name="estado" value="Total">Entrega Total</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        
                        
                    
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                                          
                                                <p for="nombre" class="text-md-center" style="font-size: 1.1rem;">{{ __('FUNCIONARIO: ') }}{{$user->nombre}} {{$user->paterno}} {{$user->materno}}</p>
                                                <p for="sucursal" class="text-md-center" style="font-size: 1.1rem;">{{ __('SUCURSAL: ') }}{{$user->sucursal}}</p>
                                                <p for="nombre" class="text-md-center" style="font-size: 1.1rem;">{{ __('FECHA: ') }}{{$cot->created_at}}</p>
                                                <p for="sucursal" class="text-md-center" style="font-size: 1.1rem;">{{ __('UNIDAD DE TRABAJO: ') }}{{$user->area}}</p>

                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
