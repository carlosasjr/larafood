@extends('adminlte::page')

@section('title', "Editar Mesa {$table->identify}" )

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>

    <h1>Editar o Mesa: {{ $table->identify }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('tables.update', $table->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.tables._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


