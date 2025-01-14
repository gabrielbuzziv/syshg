<div class="form-group">
    {!! Form::label('username', 'Usuário') !!}
    {!! Form::text('username', null, ['class' => 'form-control', $readonly]) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nome do Usuário') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'E-mail') !!}
    {!! Form::input('email', 'email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', 'Senha') !!}
    {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('roles_list', 'Funções') !!}
    {!! Form::select('roles_list[]', $roles, null, ['class' => 'form-control', 'multiple', 'id' => 'select2']) !!}
</div>

<div class="form-group">
    {!! Form::submit($btnText, ['class' => 'btn btn-success']) !!}
    <a href="{{ action('UserController@index') }}" class="btn btn-danger">Voltar</a>
</div>

@section('footer')
    <script type="text/javascript">
        jQuery(function($) {
            $('#select2').select2();
        });
    </script>
@stop