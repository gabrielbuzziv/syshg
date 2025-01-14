<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ $title  }}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-4 col-sm-12">
                {!! Form::label('codigo', 'Código') !!}
                {!! Form::text('codigo', $codigo, ['class' => 'form-control focus']) !!}
            </div>
            <div class="form-group col-md-8 col-sm-12">
                {!! Form::label('produto', 'Produto') !!}
                {!! Form::text('produto', $produto, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 col-sm-12">
                {!! Form::label('quantidade', 'Quantidade') !!}
                {!! Form::text('quantidade', $quantidade, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-4 col-sm-12">
                {!! Form::label('valor', 'Preço de Venda') !!}<br>
                {!! Form::text('valor', $valor, ['class' => 'form-control valor']) !!}
            </div>

            <div class="form-group col-md-4 col-sm-12">
                {!! Form::label('discount', 'Desconto em %') !!}<br>
                {!! Form::text('discount', $discount, ['class' => 'form-control discount valor']) !!}
            </div>
        </div>

        {!! Form::input('hidden', 'index', $index) !!}

    </div>
    <div class="modal-footer">
        @if ($continuar)
        {!! Form::submit($btnSubmitText, ['class' => 'btn btn-success pull-left']) !!}
        @endif
        {!! Form::submit($btnSubmitText . ' e Fechar', ['class' => 'btn btn-success pull-left', 'data-close' => true]) !!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    </div>
</div>

<script type="text/javascript">
    jQuery(function ($) {
        $('form#formProduto').validate({
            errorPlacement: function(error, element) { },
            rules: {
                codigo : 'required',
                produto : 'required',
                quantidade : 'required',
                valor : 'required'
            }
        });
    })
</script>