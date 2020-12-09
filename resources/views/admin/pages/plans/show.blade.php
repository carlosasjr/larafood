@extends('adminlte::page')

@section('title', 'Detalhes do plano')

@section('content_header')
    <h1>Detalhes do Plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">
            <h1>{{ $plan->name }}</h1>
        </div>

        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $plan->name }}</li>
                <li><strong>URL: </strong> {{ $plan->url }}</li>
                <li><strong>Preço: </strong> R$ {{ number_format($plan->price, 2, ',', '.') }}</li>
                <li><strong>Descrição: </strong> {{ $plan->description }}</li>
            </ul>
        </div>

        <div class="card-footer">
            <form action="{{ route('plans.destroy', $plan->url) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
@stop


