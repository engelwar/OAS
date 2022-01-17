@extends('layouts.app')

@section('template_title')
    {{ $componente->name ?? 'Show Componente' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Componente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('componentes.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $componente->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Marca:</strong>
                            {{ $componente->marca }}
                        </div>
                        <div class="form-group">
                            <strong>Modelo:</strong>
                            {{ $componente->modelo }}
                        </div>
                        <div class="form-group">
                            <strong>Caracteristicas:</strong>
                            {{ $componente->caracteristicas }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $componente->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Id Compu:</strong>
                            {{ $componente->id_compu }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
