@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        @permission('create-orcamento')
        <div class="state-information">
            <a href="{{ action('OrdemCompraController@create') }}" class="btn btn-success addon-btn m-t-10"><i
                        class="fa fa-plus"></i> Adicionar Novo</a>
        </div>
        @endpermission
    </div>

    <div class="wrapper">

        @include('partials.flash')

        <div class="row">
            <div class="col-lg-10">
                {!! Form::open(['method' => 'get', 'action' => 'OrdemCompraController@relatorio', 'class' => 'form-inline']) !!}

                <div class="form-group">
                    {!! Form::label('empresa', 'Empresa', ['class' => 'sr-only']) !!}
                    {!! Form::select('empresa', $empresas, app('request')->input('empresa'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status', ['class' => 'sr-only']) !!}
                    {!! Form::select('status', $status, (app('request')->input('status') ? app('request')->input('status') : 0), ['class' => 'form-control']) !!}
                </div>

                {!! Form::button('Filtrar', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                {!! Form::close() !!}
            </div>

            <div class="col-lg-2">
                <a href="{{ action('OrdemCompraController@relatorioImprimir') }}?{{ http_build_query(['empresa' => app('request')->input('empresa'), 'status' => app('request')->input('status')]) }}"
                   class="btn btn-default pull-right" target="_blank">
                    <i class="fa fa-print"></i> Imprimir
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading head-border">
                        {{ $title }}
                    </header>
                    <table class="table custom-table table-hover">
                        <thead>
                        <tr>
                            <th class="hidden-xs">#</th>
                            <th class="hidden-xs">Empresa</th>
                            <th>Autorizado por</th>
                            <th>Autorizado para</th>
                            <th class="hidden-xs">Gerado em</th>
                            <th class="center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ordensCompra as $ordemCompra)
                            <tr>
                                <td class="hidden-xs">{{ $ordemCompra->id }}</td>
                                <td class="hidden-xs"><a
                                            href="{{ action('OrdemCompraController@edit', $ordemCompra->id) }}">{{ $ordemCompra->empresa->apelido }}</a>
                                </td>
                                <td class="hidden-xs">{{ $ordemCompra->user->name }}</td>
                                <td>{{ $ordemCompra->para }}</td>
                                <td class="hidden-xs">{{ date('d/m/Y \à\s H:i:s', strtotime($ordemCompra->created_at)) }}</td>
                                <td align="center">
                                    @if ($ordemCompra->status == 1)
                                        <span class="label label-success">Lançado</span>
                                    @else
                                        <span class="label label-danger">Não Lançado</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $ordensCompra->links() !!}
            </div>
        </div>
    </div>

    <div id="modal" class="modal fade" role="dialog"></div>

@stop