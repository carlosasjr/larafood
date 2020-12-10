@extends('adminlte::page')

@section('title', "Editar Perfil {$profile->name}" )

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>

    <h1>Editar o Perfil: {{ $profile->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('profiles.update', $profile->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


