@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        @permission('create-permission')
        <div class="state-information">
            <a href="{{ action('PermissionController@create') }}" class="btn btn-success addon-btn m-t-10"><i class="fa fa-plus"></i> Adicionar Nova</a>
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
                            <th>Função</th>
                            <th class="hidden-xs">Nome</th>
                            <th class="hidden-xs">Descrição</th>
                            <th width="70px">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td class="hidden-xs">{{ $permission->id }}</td>
                            <td><a href="{{ action('PermissionController@edit', $permission->id) }}">{{ $permission->name }}</a></td>
                            <td class="hidden-xs">{{ $permission->display_name }}</td>
                            <td class="hidden-xs">{{ $permission->description }}</td>
                            <td width="70px">
                                @permission('edit-permission')
                                <a href="{{ action('PermissionController@edit', $permission->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                @endpermission
                                @permission('destroy-permission')
                                {!! Form::model($permission, ['method' => 'DELETE', 'action' => ['PermissionController@destroy', $permission->id], 'class' => 'remove-form']) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                                @endpermission
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $permissions->links() !!}
            </div>
        </div>
    </div>

@stop