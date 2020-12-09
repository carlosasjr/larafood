@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>

    <h1>Cadastrar novo plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('plans.store') }}" method="post">
                @csrf

                @include('admin.pages.plans._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


