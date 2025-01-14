<div class="modal-dialog">

    {!! Form::open(['id' => 'formItem']) !!}
    @include('itens.form', [
        'btnSubmitText' => 'Atualizar',
        'item' => $item['item'],
        'quantidade' => $item['quantidade'],
        'valor' => $item['valor'],
        'index' => $index,
        'continuar' => false
    ])
    {!! Form::close() !!}

</div>
