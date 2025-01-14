<div class="modal-dialog">

    {!! Form::open(['id' => 'formServico']) !!}
    @include('servicos.form', [
        'btnSubmitText' => 'Adicionar',
        'servico' => null,
        'quantidade' => null,
        'valor' => null,
        'lancamento' => null,
        'discount' => 0,
        'index' => null,
        'continuar' => true
    ])
    {!! Form::close() !!}

</div>
