@extends('layouts.default')

@section('content')
    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
        <div class="state-information">
            <a href="{{ action('ListaController@index') }}" class="btn btn-info addon-btn m-t-10"><i class="fa fa-arrow-circle-left"></i> Voltar</a>
        </div>
    </div>

    <div class="wrapper">
        @include('errors.list')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $title }}
                    </header>
                    <div class="panel-body">
                        {!! Form::model($lista, ['method' => 'PATCH', 'action' => ['ListaController@update', $lista->id], 'id' => 'formLista']) !!}
                        @include('listas.form', ['btnText' => 'Atualizar'])
                        {!! Form::close() !!}
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop