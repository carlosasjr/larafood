@extends('adminlte::page')

@section('title', "Permissões vinculadas ao Cargo {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
    </ol>

    <h1>Permissões vinculadas ao Cargo {{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('roles.permissions.create.search', $role->id) }}" method="post" class="form form-inline">
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
                <form action="{{ route('roles.permissions.store', $role->id) }}" method="POST">
                    @csrf
                    @foreach($permissions as $permission)
                        <tr>
                            <td><input type="checkbox" name="permissions[]" value="{{ $permission->id }}"></td>
                            <td>{{ $permission->name }}</td>
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


