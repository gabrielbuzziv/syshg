@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        @permission('create-orcamento')
        <div class="state-information">
            <a href="{{ action('OrcamentoController@create') }}" class="btn btn-success addon-btn m-t-10"><i
                        class="fa fa-plus"></i> Adicionar Novo</a>
        </div>
        @endpermission
    </div>

    <div class="wrapper">

        @include('partials.flash')

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading head-border">
                        {{ $title }}
                    </header>

                    <div class="col-md-12 margin-top-20 margin-bottom-20">
                        <form action="{{ action('OrcamentoController@index') }}" method="GET">
                            <input type="hidden" name="page" value="{{ app('request')->input('page') ?: 1 }}">

                            <div class="col-md-2">
                                <input type="text" name="id" class="form-control" value="{{ app('request')->input('id') ?: '' }}" placeholder="Id">
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="cliente" class="form-control" value="{{ app('request')->input('cliente') ?: '' }}" placeholder="Cliente">
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="funcionario" class="form-control" value="{{ app('request')->input('funcionario') ?: '' }}" placeholder="Funcionario">
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-primary" type="submit">Filtrar</button>
                            </div>
                        </form>
                    </div>

                    <div class="clearfix"></div>

                    <table class="table custom-table table-hover orcamentos">
                        <thead>
                            <tr>
                                <th class="hidden-xs">#</th>
                                <th>Empresa</th>
                                <th>Cliente</th>
                                <th class="hidden-xs">Funcionário</th>
                                <th>Total</th>
                                <th>Gerado em</th>
                                <th width="70px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orcamentos as $orcamento)
                            
                                <tr>
                                    <td class="hidden-xs">{{ $orcamento->id }}</td>
                                    <td>
                                        <a href="{{ action('OrcamentoController@edit', $orcamento->id) }}">{{ $orcamento->empresa->apelido }}</a>
                                    </td>
                                    <td>{{ $orcamento->cliente }}</td>
                                    <td class="hidden-xs">{{ $orcamento->user->name }}</td>
                                    <td>R$ {{ number_format($orcamento->total, 2, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $timestamp = $orcamento->created_at;
                                            $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
                                            $date->setTimezone('America/Sao_Paulo');
                                        @endphp
                                        {{ date('d/m/Y \à\s H:i:s', strtotime($date)) }}
                                    
                                    </td>
                                    <td width="175px">
                                        @permission('detail-orcamento')
                                        <a href="" class="btn btn-info btn-xs openDetalhe"
                                           data-id="{{ $orcamento->id }}" data-url="/orcamentos/detail"><i
                                                    class="fa fa-search"></i></a>
                                        @endpermission
                                        @permission('edit-orcamento')
                                        <a href="{{ action('OrcamentoController@edit', $orcamento->id) }}"
                                           class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                        @endpermission
                                        <a href="{{ action('OrcamentoController@imprimir', base64_encode($orcamento->id)) }}"
                                           target="_blank" class="btn btn-primary btn-xs"><i
                                                    class="fa fa-print"></i></a>
                                        @permission('email-orcamento')
                                        <button type="button" class="btn btn-warning btn-xs action" data-toggle="modal"
                                                data-target="#modal" data-action="emailOrcamento"
                                                data-id="{{ $orcamento->id }}">
                                            <i class="fa fa-envelope-o"></i>
                                        </button>
                                        @endpermission
                                        @permission('destroy-orcamento')
                                        {!! Form::model($orcamento, ['method' => 'DELETE', 'action' => ['OrcamentoController@destroy', $orcamento->id], 'class' => 'remove-form']) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                        @endpermission
                                    </td>
                                </tr>
                                <tr class="detalhe"></tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $orcamentos->links() !!}
            </div>
        </div>
    </div>

    <div id="modal" class="modal fade" role="dialog"></div>

@stop