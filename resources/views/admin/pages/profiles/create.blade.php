@extends('adminlte::page')

@section('title', 'Cadastrar Novo Perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfils</a></li>
    </ol>

    <h1>Cadastrar novo Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('profiles.store') }}" method="post">
                @csrf

                @include('admin.pages.profiles._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


