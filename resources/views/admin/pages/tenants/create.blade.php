@extends('adminlte::page')

@section('title', 'Cadastrar Novo Produto')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>

    <h1>Cadastrar novo Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.products._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


