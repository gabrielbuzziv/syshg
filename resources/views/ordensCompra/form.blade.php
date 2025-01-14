<div class="form-group">
    {!! Form::label('empresa_id', 'Empresa') !!}
    {!! Form::select('empresa_id', $empresas, null, ['class' => 'form-control']) !!}
</div>

<hr>

<div class="row">
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('user_id', 'Autorizado por') !!}
        {!! Form::select('user_id', $users, \Auth::user()->id, ['class' => 'form-control', 'disabled']) !!}
    </div>
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('para', 'Autorizado para') !!}
        {!! Form::text('para', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('onde_comprar', 'Onde Comprar') !!}
        {!! Form::text('onde_comprar', null, ['class' => 'form-control']) !!}
    </div>
</div>

<hr>

<div class="row">
    <div class="form-group">
        <div class="col-lg-12 m-t-20">
            <section class="panel">
                <h4 class="form-title">Itens</h4>
                <div class="pull-right btn-ordens">
                    <button type="button" class="btn btn-success addon-btn btn-sm action" data-toggle="modal"
                            data-target="#modal" data-action="createItem">
                        <i class="fa fa-plus"></i>Novo
                    </button>
                </div>
                <div class="table dd" data-list="itens">
                    <div class="thead">
                        <div class="tr">
                            <div class="th col-md-5">Item</div>
                            <div class="th col-md-2">Quantidade</div>
                            <div class="th col-md-2">Valor</div>
                            <div class="th col-md-2">Total</div>
                            <div class="th col-md-1">Ações</div>
                        </div>
                    </div>
                    <ol class="tbody itens_tbody dd-list">
                        <li class="tr">
                            <div class="td col-md-12">Não foram encontrados itens.</div>
                        </li>
                    </ol>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit($btnText, ['class' => 'btn btn-success']) !!}
    <a href="{{ action('OrdemCompraController@index') }}" class="btn btn-danger">Voltar</a>
</div>

