@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>

    <h1>Produtos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <p><a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th width="300">Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->name }}" style="max-width: 90px">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning">Ver</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('products.categories.index', $product->id) }}" class="btn btn-info"><i class="fas fa-layer-group"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $products->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $products->links("pagination::bootstrap-4") !!}
            @endif
        </div>

    </div>
@stop


