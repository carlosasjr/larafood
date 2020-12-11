@extends('adminlte::page')

@section('title', "Perfis do Plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>

    <h1>Perfis do Plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><a href="{{ route('plans.profiles.create', $plan->url) }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

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
                                 <form action="{{ route('plans.profiles.destroy', [$plan->url, $profile->id]) }}" method="post" class="form form-inline">
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
                {!! $profiles->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $profiles->links("pagination::bootstrap-4") !!}
            @endif
        </div>

    </div>
@stop


