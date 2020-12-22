@extends('adminlte::page')

@section('title', "Permissões do Cargo {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
    </ol>

    <h1>Permissões do Cargo {{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><a href="{{ route('roles.permissions.create', $role->id) }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                             <td>
                                 <form action="{{ route('roles.permissions.destroy', [$role->id, $permission->id]) }}" method="post" class="form form-inline">
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
                {!! $permissions->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $permissions->links("pagination::bootstrap-4") !!}
            @endif
        </div>

    </div>
@stop


