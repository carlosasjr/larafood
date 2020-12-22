@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
    </ol>

    <h1>Usuários</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('users.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <p><a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th width="300">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                 <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('users.roles.index', $user->id) }}" class="btn btn-dark"><i class="fas fa-address-card"></i></a>
                             </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $users->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $users->links("pagination::bootstrap-4") !!}
            @endif
        </div>

    </div>
@stop


