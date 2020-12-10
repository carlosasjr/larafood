@extends('adminlte::page')

@section('title', 'Detalhes do perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">perfil</a></li>
    </ol>

    <h1>Detalhes do perfil {{ $profile->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $profile->name }}</li>
                <li><strong>Descrição: </strong> {{ $profile->description }}</li>
            </ul>
        </div>

        <div class="card-footer">

            @include('admin.includes.alerts')

            <form action="{{ route('profiles.destroy', $profile->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
@stop


