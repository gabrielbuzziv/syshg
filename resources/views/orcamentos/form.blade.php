<div class="form-group">
    {!! Form::label('empresa_id', 'Empresa') !!}
    {!! Form::select('empresa_id', $empresas, null, ['class' => 'form-control']) !!}
</div>

<div class="page-header">
    <h4>Orçamento</h4>
</div>

<div class="row">
    <div class="form-group col-md-5 col-sm-12">
        {!! Form::label('cliente', 'Cliente') !!}
        {!! Form::text('cliente', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-2 col-sm-12">
        {!! Form::label('placa', 'Placa') !!}
        {!! Form::text('placa', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-2 col-sm-12">
        {!! Form::label('veiculo', 'Veículo') !!}
        {!! Form::text('veiculo', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        {!! Form::label('km', 'Quilometragem') !!}
        {!! Form::text('km', null, ['class' => 'form-control quilometragem']) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('observacao', 'Observacao') !!}
        {!! Form::textarea('observacao', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>
    <div class="form-group col-md-2 col-sm-12">
        {!! Form::label('telefone_comercial', 'Telefone Comercial') !!}
        {!! Form::text('telefone_comercial', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-2 col-sm-12">
        {!! Form::label('telefone_residencial', 'Telefone Residencial') !!}
        {!! Form::text('telefone_residencial', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-2 col-sm-12">
        {!! Form::label('celular', 'Celular') !!}
        {!! Form::text('celular', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('user_id', 'Funcionário') !!}
        {!! Form::select('user_id', $users, \Auth::user()->id, ['class' => 'form-control', 'disabled']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-lg-12 m-t-20">
            <section class="panel">
                <h4 class="form-title">Serviços</h4>
                <div class="pull-right btn-orcamentos">
                    <button type="button" class="btn btn-success addon-btn btn-sm action" data-toggle="modal"
                            data-target="#modal" data-action="createServico">
                        <i class="fa fa-plus"></i>Novo
                    </button>
                </div>
                <div class="table dd" data-list="servicos">
                    <div class="thead">
                        <div class="tr">
                            <div class="th col-md-2">Atividade</div>
                            <div class="th col-md-2 center">Quantidade</div>
                            <div class="th col-md-2 left">Valor</div>
                            <div class="th col-md-2 left">SubTotal</div>
                            <div class="th col-md-1 left">Desconto</div>
                            <div class="th col-md-2 left">Total</div>
                            <div class="th col-md-1 right">Ações</div>
                        </div>
                    </div>
                    <ol class="tbody servico_tbody dd-list">
                        <li class="tr">
                            <div class="td col-md-12">Não foram encontrados serviços.</div>
                        </li>
                    </ol>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-lg-12 m-t-20">
            <section class="panel">
                <h4 class="form-title">Produtos</h4>
                <div class="pull-right btn-orcamentos">
                    <button type="button" class="btn btn-success addon-btn btn-sm action" data-toggle="modal"
                            data-target="#modal" data-action="createProduto">
                        <i class="fa fa-plus"></i>Novo
                    </button>
                </div>
                <div class="table dd" data-list="produtos">
                    <div class="thead">
                        <div class="tr">
                            <div class="th col-md-1">Código</div>
                            <div class="th col-md-2">Produto</div>
                            <div class="th col-md-1 center">Quantidade</div>
                            <div class="th col-md-2 left">Preço</div>
                            <div class="th col-md-2 left">SubTotal</div>
                            <div class="th col-md-1 left">Desconto</div>
                            <div class="th col-md-2 left">Total</div>
                            <div class="th col-md-1 right">Ações</div>
                        </div>
                    </div>
                    <ol class="tbody produto_tbody dd-list">
                        <li class="tr">
                            <div class="td col-md-12">Não foram encontrados produtos.</div>
                        </li>
                    </ol>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="table">
    <div id="totalOrcamento" class="tr total col-md-12">

    </div>
</div>


<div class="page-header">
    <h4>Pagamento</h4>
</div>

<div class="form-group">
    {!! Form::label('condicoes_pagamento', 'Condições de Pagamento') !!}
    {!! Form::textarea('condicoes_pagamento', null, ['class' => 'form-control', 'rows' => 5]) !!}
</div>

<div class="form-group">
    {!! Form::submit($btnText, ['class' => 'btn btn-success']) !!}
    <a href="{{ action('OrcamentoController@index') }}" class="btn btn-danger">Voltar</a>
</div>

