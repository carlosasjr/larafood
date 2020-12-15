@extends('adminlte::page')

@section('title', "Editar Categoria {$category->name}" )

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
    </ol>

    <h1>Editar o Categoria: {{ $category->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.categories._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


