@extends('adminlte::page')

@section('title', 'Cadastrar Detalhe do Plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.details.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.details.create', $plan->url) }}">Novo</a></li>
    </ol>

    <h1>Adicionar novo detalhe ao plano: {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form" action="{{ route('plans.details.store', $plan->url) }}" method="post">
                @csrf

                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@stop


