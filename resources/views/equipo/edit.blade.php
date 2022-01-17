@extends('layouts.app')
@section('title', 'Inicio')
@section('static', 'statick-side')
@section('content')
@include('layouts.sidebar', ['hide'=>'1']) 
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Equipo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('equipos.update', $equipos->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('equipo.form_edit')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
