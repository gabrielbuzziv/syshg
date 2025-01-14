@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        <div class="state-information">
            <a href="{{ action('ContatoController@create') }}" class="btn btn-success addon-btn m-t-10"><i class="fa fa-plus"></i> Adicionar Nova</a>
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
                            <th class="hidden-xs">E-mail</th>
                            <th class="hidden-xs">Status</th>
                            <th width="70px">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($contatos as $contato)
                            <tr>
                                <td class="hidden-xs">{{ $contato->id }}</td>
                                <td><a href="{{ action('ContatoController@edit', $contato->id) }}">{{ $contato->nome }}</a></td>
                                <td class="hidden-xs">{{ $contato->email }}</td>
                                <td class="hidden-xs">{{ $contato->status }}</td>
                                <td width="70px">
                                    <a href="{{ action('ContatoController@edit', $contato->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    {!! Form::model($contato, ['method' => 'DELETE', 'action' => ['ContatoController@destroy', $contato->id], 'class' => 'remove-form']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $contatos->links() !!}
            </div>
        </div>
    </div>

@stop