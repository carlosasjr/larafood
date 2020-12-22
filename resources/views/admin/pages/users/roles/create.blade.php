@extends('adminlte::page')

@section('title', "Cargos vinculados ao Usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
    </ol>

    <h1>Cargos vinculados ao Usuário {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('users.roles.create.search', $user->id) }}" method="post" class="form form-inline">
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
                <form action="{{ route('users.roles.store', $user->id) }}" method="POST">
                    @csrf
                    @foreach($roles as $role)
                        <tr>
                            <td><input type="checkbox" name="roles[]" value="{{ $role->id }}"></td>
                            <td>{{ $role->name }}</td>
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


