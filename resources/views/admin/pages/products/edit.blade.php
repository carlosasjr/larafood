@extends('adminlte::page')

@section('title', "Editar Produto {$product->name}" )

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>

    <h1>Editar o Produto: {{ $product->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.pages.products._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


