@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        @permission('create-user')
        <div class="state-information">
            <a href="{{ action('UserController@create') }}" class="btn btn-success addon-btn m-t-10"><i class="fa fa-plus"></i> Adicionar Novo </a>
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
                            <th>Usuário</th>
                            <th class="hidden-xs">Nome</th>
                            <th class="hidden-xs">E-mail</th>
                            <th width="90px">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="hidden-xs">{{ $user->id }}</td>
                            <td><a href="{{ action('UserController@edit', $user->id) }}">{{ $user->username }}</a></td>
                            <td class="hidden-xs">{{ $user->name }}</td>
                            <td class="hidden-xs">{{ $user->email }}</td>
                            <td width="90px">
                                @permission('edit-user')
                                <a href="{{ action('UserController@edit', $user->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                @endpermission
                                @permission('destroy-user')
                                {!! Form::model($user, ['method' => 'DELETE', 'action' => ['UserController@destroy', $user->id], 'class' => 'remove-form']) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                                @endpermission
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $users->links() !!}
            </div>
        </div>
    </div>

@stop