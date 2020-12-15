@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>

    <h1>Mesas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tables.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <p><a href="{{ route('tables.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Identificação</th>
                    <th>Descrição</th>
                    <th width="300">Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach($tables as $table)
                    <tr>
                        <td>{{ $table->identify }}</td>
                        <td>{{ $table->description }}</td>
                        <td>
                            <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">Ver</a>
                            <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $tables->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $tables->links("pagination::bootstrap-4") !!}
            @endif
        </div>

    </div>
@stop


