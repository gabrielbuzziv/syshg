@extends('layouts.auth')

@section('content')
    {!! Form::open(['url' => '/password/reset', 'class' => 'form-signin']) !!}
    <div class="login-wrap">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        {!! Form::input('hidden', 'token', $token) !!}

        {!! Form::text('email', $email, ['class' => 'form-control', 'placeholder' => 'E-mail', 'autofocus', 'readonly']) !!}
        @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif

        {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Senha']) !!}
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

        {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => 'Confirmar Senha']) !!}
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
        @endif

        {!! Form::submit('Atualizar senha', ['class' => 'btn btn-lg btn-success btn-block']) !!}

    </div>
    {!! Form::close() !!}
@endsection
