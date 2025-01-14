<div class="row">
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('nome', 'Empresa') !!}
        {!! Form::text('nome', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('apelido', 'Apelido') !!}
        {!! Form::text('apelido', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="page-header">
    <h3>Endereço</h3>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('cep', 'Cep') !!}
        {!! Form::text('cep', null, ['class' => 'form-control cep']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('rua', 'Rua') !!}
        {!! Form::text('rua', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-2 col-sm-12">
        {!! Form::label('numero', 'Número') !!}
        {!! Form::text('numero', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('bairro', 'Bairro') !!}
        {!! Form::text('bairro', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('cidade', 'Cidade') !!}
        {!! Form::text('cidade', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('estado', 'Estado') !!}
        {!! Form::text('estado', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="page-header">
    <h3>Dados da Empresa</h3>
</div>

<div class="row">
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('cnpj', 'CNPJ') !!}
        {!! Form::text('cnpj', null, ['class' => 'form-control cnpj']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('ie', 'Inscrição Estadual') !!}
        {!! Form::text('ie', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('telefone', 'Telefone') !!}
        {!! Form::text('telefone', null, ['class' => 'form-control telefone']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('site', 'Site') !!}
        {!! Form::text('site', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('email', 'E-mail') !!}
        {!! Form::input('email', 'email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-12">
        {!! Form::label('email_nfe', 'E-mail NFE') !!}
        {!! Form::input('email', 'email_nfe', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- <div class="form-group">
    {!! Form::label('logo', 'Logo') !!}
    {!! Form::file('logo', null, ['class' => 'form-control file']) !!}
</div> -->

<div class="form-group">
    {!! Form::submit($btnText, ['class' => 'btn btn-success']) !!}
    <a href="{{ action('EmpresaController@index') }}" class="btn btn-danger">Voltar</a>
</div>