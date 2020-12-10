@extends('adminlte::page')

@section('title', "Editar Permissão {$permission->name}" )

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Perfis</a></li>
    </ol>

    <h1>Editar a Permissão: {{ $permission->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('permissions.update', $permission->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


