@extends('adminlte::page')

@section('title', "Editar Usuário {$user->name}" )

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
    </ol>

    <h1>Editar o Usuário: {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.users._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


