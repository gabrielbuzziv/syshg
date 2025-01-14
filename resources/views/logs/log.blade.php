@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
    </div>

    <div class="wrapper">

        @include('partials.flash')

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading head-border">
                        {{ $title }}
                    </header>
                    <table class="table custom-table table-hover orcamentos">
                        <thead>
                        <tr>
                            <th class="hidden-xs">#</th>
                            <th>Usuário</th>
                            <th class="hidden-xs">Ação</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td class="hidden-xs">{{ $log->relacao_id }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td class="hidden-xs">{{ $log->acao }}</td>
                                <td>{{ date('d/m/Y \à\s H:i:s', strtotime($log->created_at)) }}</td>
                                <td>
                                    <a href="{{ action($controller, $log->relacao_id) }}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="detalhe">

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $logs->links() !!}
            </div>
        </div>
    </div>

@stop