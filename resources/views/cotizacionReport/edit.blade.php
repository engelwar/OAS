
@extends('layouts.app')

@section('estilo')
 
@endsection

@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 





<div class="container mt-4">
   
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row row-cols-6">
                          <div class="col"></div>
                          <div class="col"></div>
                          <div class="col"></div>
                          <div class="col"></div>
                          <div class="col"></div>
                          <div class="col">  <button type="button" class="btn btn-outline-danger" onclick = "window.close ()"><span>CERRAR VENTANA</span></button></div>
                        </div>
                      </div>

                      

                    <form method="POST" action="{{route('CotizacionReporte.update',['cotizacion_report'=>$cotizacion_report->id])}}">
                        @method('PUT')
                        @csrf
                        <div class=" row d-flex justify-content-center mt-5">
                            <div class="col-2">
                                <div class="form-group row d-flex justify-content-center p-2">
                                    <a href="" type="button" class="btn btn-link"><img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/></a>
                               </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <h2 class="text-center text-primary">DETALLE OBSERVACION</h2>
                            </div>
                            
                          
                            
                        </div>
                      

                        <div class="row d-flex justify-content-center mt-4">

                            <div class="col-6">
                                
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-5 col-form-label text-md-right"></label>
        
                                    <div class="col-md-10">
                                        <span> <h5>Usuario:  {{auth()->user()->perfiles->nombre}} {{auth()->user()->perfiles->paterno}} {{auth()->user()->perfiles->materno}}</h5></span>
                                    </div>
                                        <br>
                                    <div class="col-md-10">
                                        <span> <h5>Numero de modificaciones: {{$cotizacion_report->nroMod}}</h5></span>
                                      
                                    </div>
                                    <div class="col-md-10">
                                        <span> <h5>Estado:  
                                        @foreach ($commetx as $i)
                                        @if ($i->cotizacion_form_id==$cotizacion_report->id && $i->estado=="Rechazado")
                                        <span class="text-danger"><i class="fa-lg text-danger fas fa-times"></i></span>
                                            @break
                                        @else
                                        @if ($i->cotizacion_form_id==$cotizacion_report->id && $i->estado=="Seguimiento")
                                        <span  class="text-info"><i class="text-info  fas fa-check fa-lg"></i></span>
                                            @break
                                        @endif
                                            @endif
                                         

                                        @endforeach    
                                        
                                    </h5></span>

                                    <span> <h5>Proceso:  
                                        @foreach ($commetx as $i)

                                        @if ($i->cotizacion_form_id==$cotizacion_report->id)
                                            @switch($i->estado)
                                                @case("Rechazado")
                                                <span class="text-danger"><i class="fa-lg text-danger fas fa-times"></i></span> 
                                                    @break
                                                @case("Adjudicado")
                                                <span><i class="fa-lg text-adjud fas fa-handshake"></i></span>
                                                    @break
                                                    @case("Parcial")
                                                    <span class="text-warning"><i class="fas fa-star-half text-success fa-lg"></i></span>
                                                    @break
                                                    @case("Total")
                                                    <span class="text-success"><i class="fas fa-star text-success fa-lg"></i></span>
                                                    @break
                                                @default
                                                  
                                            @endswitch
                                        @endif
                                           
                                        @endforeach    
                                        
                                    </h5></span>
                                      
                                    </div>
                                    <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="{{$cotizacion_report->nroMod}}"  >
                                </div>
                               
                         <!-- poner botones -->


                         

                    <div class="row d-flex justify-content-center my-4">
                        <div class="col-10 d-flex justify-content-center">

                            @if ($cotizacion_report->nro==0&&$cotizacion_report->nroA==0&&$cotizacion_report->nroP==0&&$cotizacion_report->nroT==0)
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento" >
                                {{ __('SEGUIMIENTO') }} <i class="fas fa-check fa-lg"></i>  
                            </button>   
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado" >
                                {{ __('ADJUDICADO') }}
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#Rechazado" >
                                {{ __('RECHAZADO') }} 
                            </button>
                            @endif 
                            
                            @if ($cotizacion_report->nro==0&&$cotizacion_report->nroA==1&&$cotizacion_report->nroP==0&&$cotizacion_report->nroT==0)
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento" >
                                {{ __('SEGUIMIENTO') }} <i class="fas fa-check fa-lg"></i>  
                            </button>   
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado2" >
                                {{ __('ADJUDICADO') }}
                            </button>
                          
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#parcial" >
                                {{ __('ENTREGA PARCIAL') }}
                            </button>
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#Total" >
                                {{ __('ENTREGA TOTAL') }}
                            </button>
                            @endif
                                
                            @if ($cotizacion_report->nro==0&&$cotizacion_report->nroA==1&&$cotizacion_report->nroP==1&&$cotizacion_report->nroT==0)
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento" >
                                {{ __('SEGUIMIENTO') }} <i class="fas fa-check fa-lg"></i>  
                            </button>   
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado2" >
                                {{ __('ADJUDICADO') }}
                            </button>
                          
                            <button type="button" class="btn btn-sm btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#parcial2" >
                                {{ __('ENTREGA PARCIAL') }}
                            </button>  
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#Total" >
                                {{ __('ENTREGA TOTAL') }}
                            </button>
                            @endif

                            @if ($cotizacion_report->nro==0&&$cotizacion_report->nroA==1&&$cotizacion_report->nroP==0&&$cotizacion_report->nroT==1)
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento" >
                                {{ __('SEGUIMIENTO') }} <i class="fas fa-check fa-lg"></i>  
                            </button>   
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado2" >
                                {{ __('ADJUDICADO') }}
                            </button>
                          
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#parcial" >
                                {{ __('ENTREGA PARCIAL') }}
                            </button>
                            <button type="button" class="btn btn-sm btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#Total2" >
                                {{ __('ENTREGA TOTAL') }}
                            </button>
                            @endif


                            @if ($cotizacion_report->nro==0&&$cotizacion_report->nroA==1&&$cotizacion_report->nroP==1&&$cotizacion_report->nroT==1)
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento" >
                                {{ __('SEGUIMIENTO') }} <i class="fas fa-check fa-lg"></i>  
                            </button>   
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado2" >
                                {{ __('ADJUDICADO') }}
                            </button>
                          
                            <button type="button" class="btn btn-sm btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#parcial2" >
                                {{ __('ENTREGA PARCIAL') }}
                            </button>  
                            <button type="button" class="btn btn-sm btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#Total2" >
                                {{ __('ENTREGA TOTAL') }}
                            </button>   

                            @endif
                           
                          
                            @if ($cotizacion_report->nro==1&&$cotizacion_report->nroA==0&&$cotizacion_report->nroP==0&&$cotizacion_report->nroT==0)
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento2">
                                {{ __('SEGUIMIENTOS') }} <i class="fas fa-check fa-lg"></i>   
                            </button>  
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado" >
                                {{ __('ADJUDICADO') }}
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#Rechazado" >
                                {{ __('RECHAZADO') }} 
                            </button>
                            @endif 
                          
                            
                            @if ($cotizacion_report->nro==1&&$cotizacion_report->nroA==1&&$cotizacion_report->nroP==0&&$cotizacion_report->nroT==0)
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento2">
                                {{ __('SEGUIMIENTOS') }} <i class="fas fa-check fa-lg"></i>   
                            </button>  
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado2" >
                                {{ __('ADJUDICADO') }}
                            </button>
                          
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#parcial" >
                                {{ __('ENTREGA PARCIAL') }}
                            </button>
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#Total" >
                                {{ __('ENTREGA TOTAL') }}
                            </button>
                            @endif
                            @if ($cotizacion_report->nro==1&&$cotizacion_report->nroA==1&&$cotizacion_report->nroP==1&&$cotizacion_report->nroT==0)
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento2">
                                {{ __('SEGUIMIENTOS') }} <i class="fas fa-check fa-lg"></i>   
                            </button>   
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado2" >
                                {{ __('ADJUDICADO') }}
                            </button>
                          
                            <button type="button" class="btn btn-sm btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#parcial2" >
                                {{ __('ENTREGA PARCIAL') }}
                            </button>  
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#Total" >
                                {{ __('ENTREGA TOTAL') }}
                            </button>
                            @endif
                            @if ($cotizacion_report->nro==1&&$cotizacion_report->nroA==1&&$cotizacion_report->nroP==1&&$cotizacion_report->nroT==1)
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento2">
                                {{ __('SEGUIMIENTOS') }} <i class="fas fa-check fa-lg"></i>   
                            </button>   
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado2" >
                                {{ __('ADJUDICADO') }}
                            </button>
                          
                            <button type="button" class="btn btn-sm btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#parcial2" >
                                {{ __('ENTREGA PARCIAL') }}
                            </button>  
                            <button type="button" class="btn btn-sm btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#Total2" >
                                {{ __('ENTREGA TOTAL') }}
                            </button>   

                            @endif
                            @if ($cotizacion_report->nro==1&&$cotizacion_report->nroA==1&&$cotizacion_report->nroP==0&&$cotizacion_report->nroT==1)
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#seguimiento2">
                                {{ __('SEGUIMIENTOS') }} <i class="fas fa-check fa-lg"></i>   
                            </button>   
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#adjudicado2" >
                                {{ __('ADJUDICADO') }}
                            </button>
                          
                            <button type="button" class="btn btn-sm btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#parcial" >
                                {{ __('ENTREGA PARCIAL') }}
                            </button>
                            <button type="button" class="btn btn-sm btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#Total2" >
                                {{ __('ENTREGA TOTAL') }}
                            </button>
                            @endif
                            
                           @if ($cotizacion_report->nro==2)
                           <button type="button" class="btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#rechazado2" >
                            {{ __('RECHAZADO') }} 
                            </button>
                            @endif

                         
                        </div>

                    </div>
                        </div>

                        

                        <div class="form-group row d-flex justify-content-center mt-5">
                                    <div class="col-5 ">
                                    <H4>OBSERVACION</H4>
                                    <input type="hidden" id="name2" name="iduser" maxlength="8" size="10" value="{{Auth::user()->id}}">
                                    <textarea class="form-control" id="message-text" name="comentario" style="white-space: nowrap; " required >{{$cotizacion_report->textObs}}</textarea>
                                    @error('obs')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>La observacion es necesaria para rechazar el formulario</strong>
                                        </div>
                                    @enderror
                                    </div>
                        </div>
                         <div class="form-group row d-flex justify-content-center mt-5">
                            @if ($cotizacion_report->nroMod == 2)
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>

                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                        <div>
                                            limite excedido de ediciones
                                        </div>
                                      </div>
                                </div>
                            </div>
                        @else
                        @if(Auth::user()->id==$cotizacion_report->user_id)
                        <div class="col-md-2 d-flex justify-content-center">
                            <div>

                            <button type="submit" class="btn btn-primary">Modificar observacion </button><!--se  necesita trabajo  para el metodo put-->
 
                            </div>
                        </div>
                        @endif
                        @endif
                                    
                        </div>
                       
                    </form>
                  
                    

                        
                 </div>
                <!--------------------->
             </div>
         </div>
     </div>
    </div>
</div>




  <!-- boton modal 2 -->


  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
  </svg>
<!-----------------ventanas caso seguimiento--------------------->
<div class="modal fade" id="seguimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Seguimiento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                @method('PUT')
                @csrf
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Texto:</label>
              <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Seguimiento">
              <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
              <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="0" >
              <input type="hidden"   name="nro" id="nro" style="text-align:right; width : 50px; heigth : 10px" value="1" >
              <textarea class="form-control" id="message-text" name="seguiComen" style="white-space: nowrap; " placeholder="Descripcion  de Seguimiento" required ></textarea>
                                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Enviar seguimiento</button>
              </div>
            </form>
        </div>
    </div>   
    </div>
    </div> 
        <div class="modal fade" id="seguimiento2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Seguimiento</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                        @method('PUT')
                        @csrf
                       
                    <div class="mb-3">
                        <div class="modal-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th style="width:130px">Fecha y hora</th>
                                        <th>Seguimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commetx as $s)
                                    @if ($cotizacion_report->id==$s->cotizacion_form_id&&$s->estado=="Seguimiento")
                                    <tr>
                                    <td>{{$s->created_at}}</td>
                                    <td>{{$s->textObs1}}</td>
                                    
                                    </tr>
                                  
                                
                                @endif
                                @endforeach
                                    
                               
                                </tbody>
                            </table>
                         
                        </div>  
                      <label for="message-text" class="col-form-label">Agregar nuevos seguimientos</label>
                      <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Seguimiento">
                      <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
                      <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="1" >
                      
                      <textarea class="form-control" id="message-text" name="seguiComen" style="white-space: nowrap; " placeholder="Descripcion  de Seguimiento (Solo puede hacer tres como maximo)" required ></textarea>
                                           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                 @foreach ($commetx as $i)
                     @if ($i->estado=="Seguimiento"&&$i->cotizacion_form_id=$cotizacion_report->id)
                         
                     @else
                         
                     @endif
                 @endforeach

                        <button type="submit" class="btn btn-primary">Nuevo Seguimiento</button>
                 
                    </div>
                    </form>
                </div>

                
            </div>
            </div>  
        </div>   
<!-----------------ventanas caso adjudicato--------------------->
<div class="modal fade" id="adjudicado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adjudicado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                @method('PUT')
                @csrf
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Texto:</label>
              <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Adjudicado">
              <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
              <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="0" >
              <input type="hidden"   name="nroAd" id="nroA" style="text-align:right; width : 50px; heigth : 10px" value="1" >
              <textarea class="form-control" id="message-text" name="seguiComen" style="white-space: nowrap; " placeholder="Descripcion  de su adjudicion" required></textarea>
                                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Adjudicar</button>
              </div>
            </form>
        </div>
    </div>   
    </div>
    </div> 

    <div class="modal fade" id="adjudicado2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adjudicado</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                    @method('PUT')
                    @csrf
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Fecha y hora :</label>

                  @foreach ($commetx as $s)
                  @if ($cotizacion_report->id==$s->cotizacion_form_id&&$s->estado=="Adjudicado")
                  {{$s->created_at}}
                  <p>Adjudicion: {{$s->textObs1}}</p>
                  @break
                  @endif
              @endforeach

                  <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Adjudicado">
                  <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
                  <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="1" >
                                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    
                  </div>
                </form>
            </div>
        </div>   
        </div>
        </div>
<!-----------------ventanas caso entrega parcial ---------------------> 
<div class="modal fade" id="parcial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Entrega parcial</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                @method('PUT')
                @csrf
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Texto:</label>
              <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Parcial">
              <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
              <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="0" >
              <textarea class="form-control" id="message-text" name="seguiComen" style="white-space: nowrap; "  placeholder="Descripcion  de su adjudicion" required ></textarea>
                                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Adjudicar</button>
              </div>
            </form>
        </div>
    </div>   
    </div>
    </div> 

    <div class="modal fade" id="parcial2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Entrega parcial</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                    @method('PUT')
                    @csrf
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Fecha y hora :</label>

                  @foreach ($commetx as $s)
                  @if ($cotizacion_report->id==$s->cotizacion_form_id&&$s->estado=="Parcial")
                  {{$s->created_at}}
                  <p>Entrega parcial: {{$s->textObs1}}</p>
                  @endif
              @endforeach

                  <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Parcial">
                  <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
                  <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="1" >
                                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    
                  </div>
                </form>
            </div>
        </div>   
        </div>
        </div>

<!-----------------ventanas caso entrega TOTAL ---------------------> 
<div class="modal fade" id="Total" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Entrega total</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                @method('PUT')
                @csrf
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Texto:</label>
              <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Total">
              <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
              <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="0" >
              <textarea class="form-control" id="message-text" name="seguiComen" style="white-space: nowrap; " placeholder="Escriba su entrega total" required ></textarea>
                                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Entrega total</button>
              </div>
            </form>
        </div>
    </div>   
    </div>
    </div> 

    <div class="modal fade" id="Total2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Entrega total</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                    @method('PUT')
                    @csrf
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Fecha y hora :</label>

                  @foreach ($commetx as $s)
                  @if ($cotizacion_report->id==$s->cotizacion_form_id&&$s->estado=="Total")
                  {{$s->created_at}}
                  <p>Entrega total: {{$s->textObs1}}</p>
                  @endif
              @endforeach

                  <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Total">
                  <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
                  <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="1" >
                                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    
                  </div>
                </form>
            </div>
        </div>   
        </div>
        </div>

  <!-----------------ventanas caso rechazado--------------------->
  <div class="modal fade" id="Rechazado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rechazar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                @method('PUT')
                @csrf
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Texto:</label>
              <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Rechazado">
              <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
              <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="0" >
              <textarea class="form-control" id="message-text" name="seguiComen" style="white-space: nowrap; " placeholder="Describa por que se rechazo" required ></textarea>
                                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Rechazar</button>
              </div>
            </form>
        </div>
    </div>   
    </div>
    </div> 

    <div class="modal fade" id="Rechazado2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Rechazar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('CotizacionReporte.estado',['cotizacion_report'=>$cotizacion_report->id])}}">
                    @method('PUT')
                    @csrf
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Fecha y hora :</label>

                  @foreach ($commetx as $s)
                  @if ($cotizacion_report->id==$s->cotizacion_form_id&&$s->estado=="Rechazado")
                  {{$s->created_at}}
                  <p>Entrega total: {{$s->textObs1}}</p>
                  @endif
              @endforeach

                  <input type="hidden" id="seguimiento" name="seguimiento" maxlength="8" size="10" value="Rechazado">
                  <input type="hidden" id="nr" name="nr" maxlength="8" size="10" value="{{$cotizacion_report->id}}">
                  <input type="hidden"   name="nroMod" id="nroMod" style="text-align:right; width : 50px; heigth : 10px" value="1" >
                                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    
                  </div>
                </form>
            </div>
        </div>   
        </div>
        </div>

@endsection

 
<script type="text/javascript">
    function enviarAlerta(){
      let dato = document.getElementsByName('texto').value.html;
      return alert(dato);
    }
  </script>
 


