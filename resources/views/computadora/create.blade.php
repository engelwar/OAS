@extends('layouts.app')
@section('title', 'Inicio')
@section('static', 'statick-side')
@section('content')
@include('layouts.sidebar', ['hide'=>'1']) 
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Computadora</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('computadoras.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('computadora.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
