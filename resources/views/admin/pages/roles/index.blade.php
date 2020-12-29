@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
    </ol>

    <h1>Cargos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('roles.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <p><a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                             <td>
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('roles.permissions.index', $role->id) }}" class="btn btn-dark"><i class="fas fa-lock"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $roles->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $roles->links("pagination::bootstrap-4") !!}
            @endif
        </div>

    </div>
@stop

