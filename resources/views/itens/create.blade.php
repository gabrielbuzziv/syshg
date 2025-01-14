<div class="modal-dialog">

    {!! Form::open(['id' => 'formItem']) !!}
    @include('itens.form', [
        'btnSubmitText' => 'Adicionar',
        'item' => null,
        'quantidade' => null,
        'valor' => null,
        'index' => null,
        'continuar' => true
    ])
    {!! Form::close() !!}

</div>
