@extends('adminlte::page')

@section('title', "Detalhes do detalhe {$detail->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.details.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.details.show', [$plan->url, $detail->id]) }}">Ver</a></li>
    </ol>

    <h1>Detalhes do detalhe: {{ $detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $detail->name }}</li>
            </ul>
        </div>


        <div class="card-footer">
            <form action="{{ route('plans.details.destroy', [$plan->url, $detail->id]) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
@stop


