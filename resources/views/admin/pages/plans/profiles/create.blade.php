@extends('adminlte::page')

@section('title', "Perfis vinculadas ao Plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>

    <h1>Perfis vinculadas ao Plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.profiles.create.search', $plan->url) }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="250">Nome</th>
                    </tr>
                </thead>

                <tbody>
                <form action="{{ route('plans.profiles.store', $plan->url) }}" method="POST">
                    @csrf
                    @foreach($profiles as $profile)
                        <tr>
                            <td><input type="checkbox" name="profiles[]" value="{{ $profile->id }}"></td>
                            <td>{{ $profile->name }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="500">
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
@stop


