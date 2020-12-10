@extends('adminlte::page')

@section('title', 'Perfils')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfils</a></li>
    </ol>

    <h1>Perfils</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('profiles.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <p><a href="{{ route('profiles.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($profiles as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>
                             <td>
                                <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-info">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $profiles->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $profiles->links("pagination::bootstrap-4") !!}
            @endif
        </div>

    </div>
@stop


