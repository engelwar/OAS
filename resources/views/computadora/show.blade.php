@extends('layouts.app')

@section('template_title')
    {{ $computadora->name ?? 'Show Computadora' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Computadora</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('computadoras.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $computadora->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Ip:</strong>
                            {{ $computadora->ip }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $computadora->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
