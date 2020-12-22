@extends('adminlte::page')

@section('title', "Editar Cargo {$role->name}" )

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
    </ol>

    <h1>Editar o Cargo: {{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('roles.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.roles._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


