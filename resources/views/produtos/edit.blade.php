<div class="modal-dialog">

    {!! Form::open(['id' => 'formProduto']) !!}
    @include('produtos.form', [
        'btnSubmitText' => 'Atualizar',
        'codigo' => $produto['codigo'],
        'produto' => $produto['produto'],
        'quantidade' => $produto['quantidade'],
        'valor' => $produto['valor'],
        'discount' => $produto['discount'],
        'index' => $index,
        'continuar' => false
    ])
    {!! Form::close() !!}

</div>
