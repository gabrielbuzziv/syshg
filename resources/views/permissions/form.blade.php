<div class="form-group">
    {!! Form::label('name', 'Função') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('display_name', 'Nome da Função') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($btnText, ['class' => 'btn btn-success']) !!}
    <a href="{{ action('PermissionController@index') }}" class="btn btn-danger">Voltar</a>
</div>