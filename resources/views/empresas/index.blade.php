@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        @permission('create-empresa')
        <div class="state-information">
            <a href="{{ action('EmpresaController@create') }}" class="btn btn-success addon-btn m-t-10"><i class="fa fa-plus"></i> Adicionar Nova</a>
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
                    <table class="table table-striped custom-table table-hover">
                        <thead>
                        <tr>
                            <th class="hidden-xs">#</th>
                            <th>Nome</th>
                            <th>Cidade</th>
                            <th width="70px">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($empresas as $empresa)
                        <tr>
                            <td class="hidden-xs">{{ $empresa->id }}</td>
                            <td><a href="{{ action('EmpresaController@edit', $empresa->id) }}">{{ $empresa->nome }}</a></td>
                            <td>{{ $empresa->cidade }}</td>
                            <td width="70px">
                                @permission('edit-empresa')
                                <a href="{{ action('EmpresaController@edit', $empresa->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                @endpermission
                                @permission('destroy-empresa')
                                {!! Form::model($empresa, ['method' => 'DELETE', 'action' => ['EmpresaController@destroy', $empresa->id], 'class' => 'remove-form']) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                                @endpermission
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $empresas->links() !!}
            </div>
        </div>
    </div>

@stop