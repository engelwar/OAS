
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
                    <form method="POST" action="">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class=" row d-flex justify-content-center mt-5">
                            <div class="col-2">
                                <div class="form-group row d-flex justify-content-center p-2">
                                    <a href="https:www.google.com" type="button" class="btn btn-link"><img alt="foto" class="img-fluid" src="{{asset('imagenes/logo.png')}}"/></a>
                               </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <h2 class="text-center text-primary">DETALLE OBSERVACION</h2>
                            </div>
                            
                            <div class="col-2 d-flex align-items-center justify-content-end">
                              
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
                                    <label for="direc" class="col-md-5 col-form-label text-md-right"></label>
        
                                    <div class="col-md-7">
                                        <input id="direc" type="text" value="" class="form-control @error('direc') is-invalid @enderror" name="direc" value="" autocomplete="direc">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-5 col-form-label text-md-right"></label>
        
                                    <div class="col-md-7">
                                        <input id="direc" type="text" value="" class="form-control @error('direc') is-invalid @enderror" name="direc" value="" autocomplete="direc">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">

                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-6 col-form-label text-md-right"></label>
        
                                    <div class="col-md-6">
                                        <input id="direc" type="text" class="form-control @error('direc') is-invalid @enderror" name="direc" value="" autocomplete="direc">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-6 col-form-label text-md-right"></label>
        
                                    <div class="col-md-6">
                                        <input id="telf_contac" type="text" class="form-control @error('telf_contac') is-invalid @enderror" name="telf_contac" value="" required autocomplete="telf_contac">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center mt-4">
                            <div class="col-6">
                                
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="OV" class="col-md-5 col-form-label text-md-right"></label>
        
                                    <div class="col-md-7">
                                 
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-5 col-form-label text-md-right"></label>
        
                                    <div class="col-md-7">
                                        <input id="n_lic" type="text" value="" class="form-control @error('n_lic') is-invalid @enderror" name="n_lic" value="" required autocomplete="n_lic">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-6 col-form-label text-md-right"></label>
        
                                    <div class="col-md-6">
                                        <input id="nit" type="text" class="form-control @error('nit') is-invalid @enderror" name="nit" value="" autocomplete="nit">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <label for="direc" class="col-md-6 col-form-label text-md-right"></label>
        
                                    <div class="col-md-6">
                                        <input id="nombre_resp" type="text" class="form-control @error('nombre_resp') is-invalid @enderror" name="nombre_resp" value="" required autocomplete="nombre_resp">
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center mt-5">
                                    <div class="col-5 ">
                                    <H4>DESCRIPCION</H4>
                                    <textarea type="text" class="form-control" style="height: 160px;" placeholder="DESCRIPCION " id="descrip" name="descrip" style="white-space: nowrap;"></textarea>
                                    @error('obs')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>La observacion es necesaria para rechazar el formulario</strong>
                                        </div>
                                    @enderror
                                    </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center mt-5">
                           
                                    
                        </div>
                    </form>


                            <div class="row d-flex justify-content-center my-4">
                                    <!--parte de estados -->
                            
                           </div>

                        
                        
                    
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                                          
                             <!--parrafos de datos con caminos -->
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 

 


