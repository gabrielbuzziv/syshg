<div class="modal-dialog">

    {!! Form::open(['id' => 'formEmailOrcamento']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ $title }}</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', null, ['class' => 'form-control focus']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'E-mail') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>

            {!! Form::input('hidden', 'id', $orcamento->id) !!}

        </div>
        <div class="modal-footer">
            {!! Form::submit('Enviar', ['class' => 'btn btn-success pull-left']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>
    {!! Form::close() !!}

</div>
