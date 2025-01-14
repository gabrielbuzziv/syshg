@extends('layouts.auth')

@section('content')
    {!! Form::open(['url' => '/login', 'class' => 'form-signin']) !!}
    <div class="login-wrap">
        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
        {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Usuário', 'autofocus']) !!}
        {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Senha']) !!}
        {!! Form::submit('LOGIN', ['class' => 'btn btn-lg btn-success btn-block']) !!}
        <label class="checkbox-custom check-success">
            {!! Form::checkbox('remember', 'remember-me', null, ['id' => 'checkbox1']) !!}
            {!! Form::label('checkbox1', 'Lembrar de mim') !!}
            <a class="pull-right" href="{{ url('/password/reset') }}">Esqueceu sua senha?</a>
        </label>
    </div>
    {!! Form::close() !!}
@endsection
