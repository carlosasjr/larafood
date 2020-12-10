@extends('adminlte::page')

@section('title', 'Cadastrar Nova Permissão')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissões</a></li>
    </ol>

    <h1>Cadastrar nova Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('permissions.store') }}" method="post">
                @csrf

                @include('admin.pages.permissions._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


