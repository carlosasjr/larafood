@extends('adminlte::page')

@section('title', "Detalhes do Plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.details.index', $plan->url) }}">Detalhes</a></li>
    </ol>

    <h1>Detalhes do Plano: {{ $plan->name }}</h1>
@stop

@section('content')
    @include('admin.includes.alerts')


    <div class="card">
        <div class="card-body">
            <p><a href="{{ route('plans.details.create', $plan->url) }}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar</a></p>

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>
                                <a href="{{ route('plans.details.show', [$plan->url, $detail->id]) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('plans.details.edit',  [$plan->url, $detail->id]) }}" class="btn btn-info">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
                {!! $details->links("pagination::bootstrap-4") !!}
         </div>

    </div>
@stop


