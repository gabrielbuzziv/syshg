@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        <div class="state-information">
            <a href="{{ action('ListaController@create') }}" class="btn btn-success addon-btn m-t-10"><i class="fa fa-plus"></i> Adicionar Nova</a>
        </div>
    </div>

    <div class="wrapper">

        @include('partials.flash')

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading head-border">
                        {{ $title }}
                    </header>
                    <table class="table table-striped custom-table table-hover">
                        <thead>
                        <tr>
                            <th class="hidden-xs">#</th>
                            <th class="hidden-xs">Nome</th>
                            <th class="hidden-xs">Descrição</th>
                            <th width="70px">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listas as $lista)
                            <tr>
                                <td class="hidden-xs">{{ $lista->id }}</td>
                                <td><a href="{{ action('ListaController@edit', $lista->id) }}">{{ $lista->nome }}</a></td>
                                <td class="hidden-xs">{{ $lista->descricao }}</td>
                                <td width="70px">
                                    <a href="{{ action('ListaController@edit', $lista->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    {!! Form::model($lista, ['method' => 'DELETE', 'action' => ['ListaController@destroy', $lista->id], 'class' => 'remove-form']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $listas->links() !!}
            </div>
        </div>
    </div>

@stop