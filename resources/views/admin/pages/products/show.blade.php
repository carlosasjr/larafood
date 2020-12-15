@extends('adminlte::page')

@section('title', 'Detalhes da Categoria')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
    </ol>

    <h1>Detalhes da Categoria {{ $category->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $category->name }}</li>
                <li><strong>Descrição: </strong> {{ $category->description }}</li>
                <li><strong>URL: </strong> {{ $category->url }}</li>
                <li><strong>Empresa: </strong> {{ $category->tenant->name }}</li>
            </ul>
        </div>

        <div class="card-footer">

            @include('admin.includes.alerts')

            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
@stop


