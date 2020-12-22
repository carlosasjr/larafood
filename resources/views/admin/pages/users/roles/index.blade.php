@extends('adminlte::page')

@section('title', "Cargos do Usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
    </ol>

    <h1>Cargos do Usuário {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><a href="{{ route('users.roles.create', $user->id) }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

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
                                 <form action="{{ route('users.roles.destroy', [$user->id, $role->id]) }}" method="post" class="form form-inline">
                                     @csrf
                                     @method('delete')

                                     <button type="submit" class="btn btn-danger">Deletar</button>
                                 </form>
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


