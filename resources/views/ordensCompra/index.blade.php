@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        @permission('create-orcamento')
        <div class="state-information">
            <a href="{{ action('OrdemCompraController@create') }}" class="btn btn-success addon-btn m-t-10"><i class="fa fa-plus"></i> Adicionar Novo</a>
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
                    <table class="table custom-table table-hover">
                        <thead>
                        <tr>
                            <th class="hidden-xs">#</th>
                            <th class="hidden-xs">Empresa</th>
                            <th>Autorizado por</th>
                            <th>Autorizado para</th>
                            <th class="hidden-xs">Gerado em</th>
                            <th class="center">Status</th>
                            <th width="140px">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ordensCompra as $ordemCompra)
                            <tr>
                                <td class="hidden-xs">{{ $ordemCompra->id }}</td>
                                <td class="hidden-xs"><a href="{{ action('OrdemCompraController@edit', $ordemCompra->id) }}">{{ $ordemCompra->empresa->apelido }}</a></td>
                                <td class="hidden-xs">{{ $ordemCompra->user->name }}</td>
                                <td>{{ $ordemCompra->para }}</td>
                                <td class="hidden-xs">
                                    @php
                                        $timestamp = $ordemCompra->created_at;
                                        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
                                        $date->setTimezone('America/Sao_Paulo');
                                    @endphp
                                    {{ $date }}
                                </td>
                                <td align="center">
                                    @if ($ordemCompra->status)
                                        <span class="label label-success">Lançado</span>
                                    @else
                                        @if (Auth::user()->can('lancar-ordem-compra'))
                                            <a href="{{ action('OrdemCompraController@lancar', $ordemCompra->id) }}" class="label label-danger">Não lançado</a>
                                        @else
                                            <span class="label label-danger">Não Lançado</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @permission('detail-ordem-compra')
                                    <a href="" class="btn btn-info btn-xs openDetalhe" data-id="{{ $ordemCompra->id }}" data-url="{{ action('OrdemCompraController@detail') }}"><i class="fa fa-search"></i></a>
                                    @endpermission
                                    @permission('edit-ordem-compra')
                                    <a href="{{ action('OrdemCompraController@edit', $ordemCompra->id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                    @endpermission
                                    @permission('print-ordem-compra')
                                    <a href="{{ action('OrdemCompraController@imprimir', base64_encode($ordemCompra->id)) }}" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-print"></i></a>
                                    @endpermission
                                    @permission('destroy-ordem-compra')
                                    {!! Form::model($ordensCompra, ['method' => 'DELETE', 'action' => ['OrdemCompraController@destroy', $ordemCompra->id], 'class' => 'remove-form']) !!}
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

                {!! $ordensCompra->links() !!}
            </div>
        </div>
    </div>

    <div id="modal" class="modal fade" role="dialog"></div>

@stop