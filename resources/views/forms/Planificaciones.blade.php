@extends('layouts.app')
@section('title', 'Inicio')
@section('content') 
  <div class="row d-flex justify-content-center py-4 w-100">
    <div class="container border rounded col-12 bg-light p-4">    
          <div class="row p-2 ">
            <div class="col-12 d-flex justify-content-center">
              <h3>REGISTRO DE PLANIFICACIONES</h3>
            </div>
          </div>

          <div class="row border-primary d-flex justify-content-center" style="border-bottom: solid;">
            <div class="col-11">
              <form method="POST" action="{{ route('planificacion.store') }}">
                @csrf
                <div class="table-responsive text-center my-4" >
                  <table class="table table-bordered table-sm" >
                    <thead>
                      <th>Actividad</th> 
                      <th style="width: 100px;">Fecha</th> 
                      <th colspan="2">Opciones</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="align-middle" >
                          <input type="text" id="activ" name="activ" class="w-100 form-control @error('activ') is-invalid @enderror">
                          @error('activ')
                            <span class="invalid-feedback" role="alert">
                              <strong>Ingresar la actividad es necesario</strong>
                            </span>
                          @enderror
                        </td>
                        <td class="align-middle">
                          <input type="date" class="form-control" min="{{date('Y-m-d',strtotime(date('Y-m-d').'+ 1 days'))}}" 
                          id="fecha" name="fecha" value="{{date('Y-m-d',strtotime(date('Y-m-d').'+ 1 days'))}}" @if(date('H:i') < '08:00' || date('H:i') > '21:00' ) disabled @endif>
                        </td>
                        
                        <td class="align-middle" style="width: 20px;" >                          
                              <button type="submit" class="btn btn-danger" @if(date('H:i') < '08:00' || date('H:i') > '21:00' ) disabled @endif>
                                {{ __('Planificar') }}
                              </button>
                        </td>
                            <td class="align-middle" style="width: 20px;">
                              <button type="submit" class="btn btn-warning" id="imprev"  name="imprev" value="imprev" data-toggle="tooltip" data-placement="left" title="Un imprevisto es una tarea no programada en la planificacion, se guarda unicamente para el presente dia. "  @if(date('H:i') < '09:00' || date('H:i') > '16:00' ) disabled @endif>
                              {{ __('Imprevisto') }}
                              </button>        
                          </td>
                                                                       
                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>

          <div class="row" style="margin-top:70px;">
            <div class="col-12 d-flex justify-content-center"><h3>PLANIFICACION</h3></div>
          </div>

          <div class="row ">
            <div class="col d-flex justify-content-center">
              <p>
                Pendiente <span style="font-size: 1.5rem;" class="text-secondary">■</span> 
                - No Completado <span style="font-size: 1.5rem;" class="text-danger">■</span> 
                - Completado <span style="font-size: 1.5rem;" class="text-success">■</span>
              </p>
            </div>
          </div>
          <div class="row pb-4">
            <div class="col">
            </div>
            <div class="col-3">
              <form class="form-inline" action="{{action('PlanificacionController@create')}}" method="GET">
                  <input id="busca" name="busca" class="form-control col-4 col-sm-auto ml-auto"type="date" @if($busca===NULL) value="date('Y-m-d')" @else value="{{$busca}}" @endif aria-label="Search">
                  <button class="form-control btn btn-primary col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">Buscar</button>
                </form>
                
              </div>
              @if($busca!==NULL)
              <div class="col-1 d-flex justify-content-start">
                <form action="{{action('PlanificacionController@create')}}" method="GET">
                    <button class="form-control btn btn-primary" type="submit">x</button>
                </form>
              </div>
            @endif
            @if(count($plan->where('estado','===', NULL))>0)
              @if(Auth::user()->rol=='admin')
              
                <div class="col-2">
                  <form method="POST" action="{{ route('planificacion.finalizar')}}">
                    @csrf
                    <button class="form-control btn btn-danger col-4 col-sm-auto ml-auto ml-sm-2 d-none d-sm-block" type="submit">
                      Finalizar Día
                    </button>
                  </form>
                </div>
              @endif
            @endif
          </div>
          {{ $plan->links() }}  
          @if($plan->count())
          <div class="table-responsive text-center" >
            <table class="table table-bordered table-sm">

             <thead class="bg-primary text-light">
                <th style="width: 180px;">Fecha y Hora de Registro</th>  
                <th style="width: 100px;">Jornada</th>  
                <th style="min-width: 300px; max-width: 300px;">Actividad</th> 
                <th style="max-width: 250px;">Propietario</th>
                <th style="max-width: 35px;">E</th>
                <th style="width: 100px;" colspan="2">OPCIONES</th>
             </thead>
              @foreach($plan as $p)
              <tbody>
              <tr >
                <td class="align-middle">{{$p->created_at}}</td>
                <td class="align-middle">{{$p->fecha}}</td>
                <td class="align-middle">{{$p->activ}}</td>
                <td class="align-middle">{{$p->user->nombre}} {{$p->user->paterno}}</td>
                <td class="@if($p->estado===NULL)bg-secondary @elseif($p->estado===1) bg-success @elseif($p->estado===0) bg-danger @endif" style="width: 30px;"></td>
                <td class="align-middle" style="width: 50px;">

  @if($p->estado===NULL)
  @if(date('H:i') > '8:00' || date('H:i') < '18:00')          
                  @if(Auth::user()->id==$p->user_id)
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#si_{{$p->id}}">
              Completado
            </button>
            @endif
    <!-- Modal COMPLETADO-->
    <div class="modal fade" id="si_{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Completado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ route('planificacion.update', $p->id) }}">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
          <div class="modal-body">
          <textarea id="coment_complet"name="coment" cols="60" rows="5" placeholder="Comentarios">

          </textarea>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="est" name="est" value="1">
            <button type="submit" class="btn btn-success">Aceptar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    @endif
@else
<button type="button" class="btn btn-sm @if($p->estado==1) btn-success @else btn-danger @endif" data-toggle="modal" data-target="#si_{{$p->id}}">
  Comentario
</button>
<!-- Modal COMPLETADO-->
<div class="modal fade" id="si_{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <textarea id="coment_complet"name="coment" cols="60" rows="5" placeholder="Comentarios" class="font-weight-bold">
        {{$p->coment}}
      </textarea>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="est" name="est" value="1">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  @endif

</td>
<td class="align-middle" style="width: 130px;">
@if(date('H:i') > '8:00' || date('H:i') < '18:00')
@if($p->estado===NULL)
@if(Auth::user()->id==$p->user_id)
<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#no_{{$p->id}}">
  No Completado
</button>
@endif
<!-- Modal NO COMPLETADO-->
<div class="modal fade" id="no_{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">No Completado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('planificacion.update' , $p->id) }}">
                @csrf
                <input name="_method" type="hidden" value="PATCH">
      <div class="modal-body">
      <textarea id="coment"name="coment" cols="60" rows="5" placeholder="Observaciones">

      </textarea>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="est" name="est" value="2">
        <button type="submit" class="btn btn-danger">Aceptar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@else
@if($p->post===NULL && $p->estado===0)
<form method="POST" action="{{ route('planificacion.nextDay' , $p->id) }}">
                @csrf
        <button type="submit" class="btn btn-sm text-light" style="background-color:rgb(158, 107, 253);">Siguiente día</button>
</form>
@endif
@endif
@endif
                </td>
               </tr>
              </tbody>
               @endforeach
                
              
            
          </table>
          </div>
          @else
              <div class="text-center">Aun no hay Registro!!<div>
          @endif
          {{ $plan->links() }}  
    </div>          
  </div>
@endsection
@section('mis_scripts')
<script>
  $(function () {
    $('#imprev').tooltip()
  })
</script>
@endsection
