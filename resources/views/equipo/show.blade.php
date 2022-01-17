@extends('layouts.app')

@section('template_title')
    {{ $equipo->name ?? 'Show Equipo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Equipo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('equipos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Marca:</strong>
                            {{ $equipo->marca }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $equipo->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Modelo:</strong>
                            {{ $equipo->modelo }}
                        </div>
                        <div class="form-group">
                            <strong>Ns:</strong>
                            {{ $equipo->ns }}
                        </div>
                        <div class="form-group">
                            <strong>Caracteristicas:</strong>
                            {{ $equipo->caracteristicas }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $equipo->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Id Empleado:</strong>
                            {{ $equipo->id_empleado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
