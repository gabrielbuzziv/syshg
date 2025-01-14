<div class="form-group">
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('descricao', 'Descrição') !!}
    {!! Form::textarea('descricao', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::button($btnText, ['class' => 'btn btn-success ', 'type' => 'submit']) !!}
    <a href="{{ action('ListaController@index') }}" class="btn btn-danger">Cancelar</a>
</div>