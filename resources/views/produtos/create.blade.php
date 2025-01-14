<div class="modal-dialog">

    {!! Form::open(['id' => 'formProduto']) !!}
    @include('produtos.form', [
        'btnSubmitText' => 'Adicionar',
        'codigo' => null,
        'produto' => null,
        'quantidade' => null,
        'valor' => null,
        'discount' => 0,
        'index' => null,
        'continuar' => true
    ])
    {!! Form::close() !!}

</div>
