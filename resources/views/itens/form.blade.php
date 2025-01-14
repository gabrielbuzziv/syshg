<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ $title  }}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
                {!! Form::label('item', 'Item') !!}
                {!! Form::text('item', $item, ['class' => 'form-control focus']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-sm-12">
                {!! Form::label('quantidade', 'Quantidade') !!}
                {!! Form::text('quantidade', $quantidade, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-6 col-sm-12">
                {!! Form::label('valor', 'Valor') !!}
                {!! Form::text('valor', $valor, ['class' => 'form-control valor']) !!}
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
        $('form#formItem').validate({
            errorPlacement: function(error, element) { },
            rules: {
                item: 'required',
                quantidade: {
                    required: true,
                    number: true
                }
            }
        });
    })
</script>