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
    {!! Form::label('permissions_list', 'Permissões') !!}
    {!! Form::select('permissions_list[]', $permissions, null, ['class' => 'form-control', 'multiple', 'id' => 'select2']) !!}
</div>

<div class="form-group">
    {!! Form::submit($btnText, ['class' => 'btn btn-success']) !!}
    <a href="{{ action('RoleController@index') }}" class="btn btn-danger">Voltar</a>
</div>

@section('footer')
    <script type="text/javascript">
        jQuery(function($) {
            $('#select2').select2();
        });
    </script>
@stop