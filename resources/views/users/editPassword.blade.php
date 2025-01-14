@extends('layouts.default')

@section('content')
    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
    </div>

    <div class="wrapper">
        @include('errors.list')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $title }}
                    </header>
                    <div class="panel-body">

                        @include('partials.flash')

                        {!! Form::model($user, ['action' => ['UserController@updatePassword', $user->id], 'id' => 'formPassword']) !!}

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                {!! Form::label('password', 'Senha') !!}
                                {!! Form::input('password', 'password', null, ['class' => 'form-control', 'id' => 'password']) !!}
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                {!! Form::label('confirm_password', 'Confirmar Senha') !!}
                                {!! Form::input('password', 'confirm_password', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::button('Atualizar', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop