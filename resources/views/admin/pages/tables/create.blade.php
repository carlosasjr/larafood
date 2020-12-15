@extends('adminlte::page')

@section('title', 'Cadastrar Nova Mesa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>

    <h1>Cadastrar Nova Mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="car-header">

        </div>

        <div class="card-body">
            <form class="form" action="{{ route('tables.store') }}" method="post">
                @csrf

                @include('admin.pages.tables._partials.form')
            </form>
        </div>

        <div class="card-footer">

        </div>

    </div>
@stop


