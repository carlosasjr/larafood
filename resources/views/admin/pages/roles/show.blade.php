@extends('adminlte::page')

@section('title', 'Detalhes do cargo')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Cargo</a></li>
    </ol>

    <h1>Detalhes do cargo {{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $role->name }}</li>
                <li><strong>Descrição: </strong> {{ $role->description }}</li>
            </ul>
        </div>

        <div class="card-footer">

            @include('admin.includes.alerts')

            <form action="{{ route('role.destroy', $role->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
@stop


