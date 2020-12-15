@extends('adminlte::page')

@section('title', "Categorias do Produto {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>

    <h1>Categorias do Produto {{ $product->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><a href="{{ route('products.categories.create', $product->id) }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                             <td>
                                 <form action="{{ route('products.categories.destroy', [$product->id, $category->id]) }}" method="post" class="form form-inline">
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
                {!! $categories->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $categories->links("pagination::bootstrap-4") !!}
            @endif
        </div>

    </div>
@stop


