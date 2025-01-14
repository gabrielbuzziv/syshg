<div class="modal-dialog">

    {!! Form::open(['id' => 'formServico']) !!}
    @include('servicos.form', [
        'btnSubmitText' => 'Atualizar',
        'servico' => $servico['servico'],
        'quantidade' => $servico['quantidade'],
        'valor' => $servico['valor'],
        'lancamento' => $servico['lancamento'],
        'discount' => $servico['discount'],
        'index' => $index,
        'continuar' => false
    ])
    {!! Form::close() !!}

</div>
