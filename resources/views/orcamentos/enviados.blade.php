@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
    </div>

    <div class="wrapper">

        @include('partials.flash')

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading head-border">
                        {{ $title }}
                    </header>
                    <table class="table custom-table table-hover orcamentos">
                        <thead>
                        <tr>
                            <th class="hidden-xs">#</th>
                            <th>Orçamento</th>
                            <th class="hidden-xs">Nome</th>
                            <th>E-mail</th>
                            <th>Enviado por</th>
                            <th>Data de Envio</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($emails as $email)
                            <tr>
                                <td class="hidden-xs">{{ $email->id }}</td>
                                <td>#{{ $email->orcamento->id }}</td>
                                <td class="hidden-xs">{{ $email->nome }}</td>
                                <td>{{ $email->email }}</td>
                                <td>{{ $email->user->name }}</td>
                                <td>{{ $email->created_at }}</td>
                            </tr>
                            <tr class="detalhe">

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

                {!! $emails->links() !!}
            </div>
        </div>
    </div>

@stop