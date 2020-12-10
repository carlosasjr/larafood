@extends('adminlte::page')

@section('title', "Editar o detalhe {$detail->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.details.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.details.edit', [$plan->url, $detail->id]) }}">Editar</a></li>
    </ol>

    <h1>Editar detalhe: {{ $detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form" action="{{ route('plans.details.update', [$plan->url, $detail->id]) }}" method="post">
                @csrf
                @method('put')

                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@stop


