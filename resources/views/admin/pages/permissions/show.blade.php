@extends('adminlte::page')

@section('title', 'Detalhes da Permissão')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">perfil</a></li>
    </ol>

    <h1>Detalhes da permissão: {{ $permission->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $permission->name }}</li>
                <li><strong>Descrição: </strong> {{ $permission->description }}</li>
            </ul>
        </div>

        <div class="card-footer">

            @include('admin.includes.alerts')

            <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
@stop


