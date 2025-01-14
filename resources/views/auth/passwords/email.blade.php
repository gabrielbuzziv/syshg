@extends('layouts.auth')

<!-- Main Content -->
@section('content')
    {!! Form::open(['url' => '/password/email', 'class' => 'form-signin']) !!}
    <div class="login-wrap">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail', 'autofocus']) !!}
        {!! Form::submit('Solicitar nova senha', ['class' => 'btn btn-lg btn-success btn-block']) !!}

    </div>
    {!! Form::close() !!}
@endsection
