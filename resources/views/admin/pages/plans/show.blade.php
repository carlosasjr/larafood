@extends('adminlte::page')

@section('title', 'Detalhes do plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>

    <h1>Detalhes do Plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $plan->name }}</li>
                <li><strong>URL: </strong> {{ $plan->url }}</li>
                <li><strong>Preço: </strong> R$ {{ number_format($plan->price, 2, ',', '.') }}</li>
                <li><strong>Descrição: </strong> {{ $plan->description }}</li>
            </ul>
        </div>

        <div class="card-footer">

            @include('admin.includes.alerts')

            <form action="{{ route('plans.destroy', $plan->url) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
@stop


