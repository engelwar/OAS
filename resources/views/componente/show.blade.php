@extends('layouts.app')
@section('title', 'Inicio')
@section('static', 'statick-side')
@section('content')
@include('layouts.sidebar', ['hide'=>'1']) 
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('empleados.show', $computadoras->id_empleado) }}">Atras</a>
                        </div>
                    </div>
                    <div class="card-body">
                      <h3>Componentes</h3>
                      <div class="cpu w-50">
                        <div class="table-responsive">
                          <table class="table table-striped table-hover">
                            <thead class="thead">
                              <tr>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Caracteristicas</th>
                                <th style="text-align: center">Descripcion de estado</th>
                                <th>Estado</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              @if ($componentes != null)
                              @foreach ($componentes as $componente)
                                  <tr>
                                    <td>{{ $componente->tipo }}</td>
                                    <td>{{ $componente->marca }}</td>
                                    <td>{{ $componente->modelo }}</td>
                                    <td>{{ $componente->caracteristicas }}</td>
                                    <td>{{ $componente->estado }}</td>
                                    <td>
                                      @if ($componente->estadoBM =="bueno")
                                      <button type="button" class="btn btn-outline-success" disabled><i class='fa fa-bolt'></i></button>
                                      @else
                                      <button type="button" class="btn btn-outline-danger" disabled><i class='fa fa-bolt'></i></button>
                                      @endif
                                     
                                  </tr>
                              @endforeach 
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
