@if ($contato)
    @if (count($contato->listas) > 0)
        <h4>Lista</h4>
        @foreach ($contato->listas as $lista)
            <span class="label label-primary">{{ $lista->nome }}</span>
        @endforeach
    @endif
@endif

<div class="form-group">
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', [0 => 'Desinscrito', 1 => 'Inscrito'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::button($btnText, ['class' => 'btn btn-success ', 'type' => 'submit']) !!}
    <a href="{{ action('ListaController@index') }}" class="btn btn-danger">Cancelar</a>
</div>