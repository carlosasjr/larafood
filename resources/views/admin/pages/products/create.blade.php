@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
    </ol>

    <h1>Cadastrar nova Categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('categories.store') }}" method="post">
                @csrf

                @include('admin.pages.categories._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


