@extends('adminlte::page')

@section('title', 'Detalhes do Produto')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>

    <h1>Detalhes do Produto {{ $product->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><img src="{{ asset("storage/$product->image") }}" alt="{{ $product->name }}" style="max-width: 90px"></li>
                <li><strong>Nome: </strong> {{ $product->name }}</li>
                <li><strong>Descrição: </strong> {{ $product->description }}</li>
                <li><strong>URL: </strong> {{ $product->url }}</li>
                <li><strong>Empresa: </strong> {{ $product->tenant->name }}</li>
            </ul>
        </div>

        <div class="card-footer">

            @include('admin.includes.alerts')

            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
@stop


